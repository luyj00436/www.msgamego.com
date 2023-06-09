<?php
/**
 * This is a modified version of the POMO library included with WordPress. The WordPress copyright has been included
 * for attribution.
 */

/*
WordPress - Web publishing software

Copyright 2011-2020 by the contributors

This program is free software; you can redistribute it and/or modify
it under the terms of the GNU General Public License as published by
the Free Software Foundation; either version 2 of the License, or
(at your option) any later version.

This program is distributed in the hope that it will be useful,
but WITHOUT ANY WARRANTY; without even the implied warranty of
MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
GNU General Public License for more details.

You should have received a copy of the GNU General Public License
along with this program; if not, write to the Free Software
Foundation, Inc., 51 Franklin St, Fifth Floor, Boston, MA  02110-1301  USA

This program incorporates work covered by the following copyright and
permission notices:

  b2 is (c) 2001, 2002 Michel Valdrighi - https://cafelog.com

  Wherever third party code has been used, credit has been given in the code's
  comments.

  b2 is released under the GPL

and

  WordPress - Web publishing software

  Copyright 2003-2010 by the contributors

  WordPress is released under the GPL
 */


/**
 * A gettext Plural-Forms parser.
 *
 * @since 4.9.0
 */
class wfPlural_Forms
{
    /**
     * Operator characters.
     *
     * @since 4.9.0
     * @var string OP_CHARS Operator characters.
     */
    const OP_CHARS = '|&><!=%?:';

    /**
     * Valid number characters.
     *
     * @since 4.9.0
     * @var string NUM_CHARS Valid number characters.
     */
    const NUM_CHARS = '0123456789';

    /**
     * Operator precedence.
     *
     * Operator precedence from highest to lowest. Higher numbers indicate
     * higher precedence, and are executed first.
     *
     * @see https://en.wikipedia.org/wiki/Operators_in_C_and_C%2B%2B#Operator_precedence
     *
     * @since 4.9.0
     * @var array $op_precedence Operator precedence from highest to lowest.
     */
    protected static $op_precedence = array(
        '%' => 6,

        '<' => 5,
        '<=' => 5,
        '>' => 5,
        '>=' => 5,

        '==' => 4,
        '!=' => 4,

        '&&' => 3,

        '||' => 2,

        '?:' => 1,
        '?' => 1,

        '(' => 0,
        ')' => 0,
    );

    /**
     * Tokens generated from the string.
     *
     * @since 4.9.0
     * @var array $tokens List of tokens.
     */
    protected $tokens = array();

    /**
     * Cache for repeated calls to the function.
     *
     * @since 4.9.0
     * @var array $cache Map of $n => $result
     */
    protected $cache = array();

    /**
     * Constructor.
     *
     * @param string $str Plural function (just the bit after `plural=` from Plural-Forms)
     * @since 4.9.0
     *
     */
    public function __construct($str)
    {
        $this->parse($str);
    }

    /**
     * Parse a Plural-Forms string into tokens.
     *
     * Uses the shunting-yard algorithm to convert the string to Reverse Polish
     * Notation tokens.
     *
     * @param string $str String to parse.
     * @since 4.9.0
     *
     */
    protected function parse($str)
    {
        $pos = 0;
        $len = strlen($str);

        // Convert infix operators to postfix using the shunting-yard algorithm.
        $output = array();
        $stack = array();
        while ($pos < $len) {
            $next = substr($str, $pos, 1);

            switch ($next) {
                // Ignore whitespace.
                case ' ':
                case "\t":
                    $pos++;
                    break;

                // Variable (n).
                case 'n':
                    $output[] = array('var');
                    $pos++;
                    break;

                // Parentheses.
                case '(':
                    $stack[] = $next;
                    $pos++;
                    break;

                case ')':
                    $found = false;
                    while (!empty($stack)) {
                        $o2 = $stack[count($stack) - 1];
                        if ('(' !== $o2) {
                            $output[] = array('op', array_pop($stack));
                            continue;
                        }

                        // Discard open paren.
                        array_pop($stack);
                        $found = true;
                        break;
                    }

                    if (!$found) {
                        throw new Exception('Mismatched parentheses');
                    }

                    $pos++;
                    break;

                // Operators.
                case '|':
                case '&':
                case '>':
                case '<':
                case '!':
                case '=':
                case '%':
                case '?':
                    $end_operator = strspn($str, self::OP_CHARS, $pos);
                    $operator = substr($str, $pos, $end_operator);
                    if (!array_key_exists($operator, self::$op_precedence)) {
                        throw new Exception(sprintf('Unknown operator "%s"', $operator));
                    }

                    while (!empty($stack)) {
                        $o2 = $stack[count($stack) - 1];

                        // Ternary is right-associative in C.
                        if ('?:' === $operator || '?' === $operator) {
                            if (self::$op_precedence[$operator] >= self::$op_precedence[$o2]) {
                                break;
                            }
                        } elseif (self::$op_precedence[$operator] > self::$op_precedence[$o2]) {
                            break;
                        }

                        $output[] = array('op', array_pop($stack));
                    }
                    $stack[] = $operator;

                    $pos += $end_operator;
                    break;

                // Ternary "else".
                case ':':
                    $found = false;
                    $s_pos = count($stack) - 1;
                    while ($s_pos >= 0) {
                        $o2 = $stack[$s_pos];
                        if ('?' !== $o2) {
                            $output[] = array('op', array_pop($stack));
                            $s_pos--;
                            continue;
                        }

                        // Replace.
                        $stack[$s_pos] = '?:';
                        $found = true;
                        break;
                    }

                    if (!$found) {
                        throw new Exception('Missing starting "?" ternary operator');
                    }
                    $pos++;
                    break;

                // Default - number or invalid.
                default:
                    if ($next >= '0' && $next <= '9') {
                        $span = strspn($str, self::NUM_CHARS, $pos);
                        $output[] = array('value', intval(substr($str, $pos, $span)));
                        $pos += $span;
                        break;
                    }

                    throw new Exception(sprintf('Unknown symbol "%s"', $next));
            }
        }

        while (!empty($stack)) {
            $o2 = array_pop($stack);
            if ('(' === $o2 || ')' === $o2) {
                throw new Exception('Mismatched parentheses');
            }

            $output[] = array('op', $o2);
        }

        $this->tokens = $output;
    }

    /**
     * Get the plural form for a number.
     *
     * Caches the value for repeated calls.
     *
     * @param int $num Number to get plural form for.
     * @return int Plural form value.
     * @since 4.9.0
     *
     */
    public function get($num)
    {
        if (isset($this->cache[$num])) {
            return $this->cache[$num];
        }
        $this->cache[$num] = $this->execute($num);
        return $this->cache[$num];
    }

    /**
     * Execute the plural form function.
     *
     * @param int $n Variable "n" to substitute.
     * @return int Plural form value.
     * @since 4.9.0
     *
     */
    public function execute($n)
    {
        $stack = array();
        $i = 0;
        $total = count($this->tokens);
        while ($i < $total) {
            $next = $this->tokens[$i];
            $i++;
            if ('var' === $next[0]) {
                $stack[] = $n;
                continue;
            } elseif ('value' === $next[0]) {
                $stack[] = $next[1];
                continue;
            }

            // Only operators left.
            switch ($next[1]) {
                case '%':
                    $v2 = array_pop($stack);
                    $v1 = array_pop($stack);
                    $stack[] = $v1 % $v2;
                    break;

                case '||':
                    $v2 = array_pop($stack);
                    $v1 = array_pop($stack);
                    $stack[] = $v1 || $v2;
                    break;

                case '&&':
                    $v2 = array_pop($stack);
                    $v1 = array_pop($stack);
                    $stack[] = $v1 && $v2;
                    break;

                case '<':
                    $v2 = array_pop($stack);
                    $v1 = array_pop($stack);
                    $stack[] = $v1 < $v2;
                    break;

                case '<=':
                    $v2 = array_pop($stack);
                    $v1 = array_pop($stack);
                    $stack[] = $v1 <= $v2;
                    break;

                case '>':
                    $v2 = array_pop($stack);
                    $v1 = array_pop($stack);
                    $stack[] = $v1 > $v2;
                    break;

                case '>=':
                    $v2 = array_pop($stack);
                    $v1 = array_pop($stack);
                    $stack[] = $v1 >= $v2;
                    break;

                case '!=':
                    $v2 = array_pop($stack);
                    $v1 = array_pop($stack);
                    $stack[] = $v1 != $v2;
                    break;

                case '==':
                    $v2 = array_pop($stack);
                    $v1 = array_pop($stack);
                    $stack[] = $v1 == $v2;
                    break;

                case '?:':
                    $v3 = array_pop($stack);
                    $v2 = array_pop($stack);
                    $v1 = array_pop($stack);
                    $stack[] = $v1 ? $v2 : $v3;
                    break;

                default:
                    throw new Exception(sprintf('Unknown operator "%s"', $next[1]));
            }
        }

        if (count($stack) !== 1) {
            throw new Exception('Too many values remaining on the stack');
        }

        return (int)$stack[0];
    }
}
