<?php
// phpcs:ignoreFile -- compatibility library for PHP 5-7.1

if (class_exists('ParagonIE_Sodium_Core32_Curve25519_Ge_Precomp', false)) {
    return;
}

/**
 * Class ParagonIE_Sodium_Core32_Curve25519_Ge_Precomp
 */
class ParagonIE_Sodium_Core32_Curve25519_Ge_Precomp
{
    /**
     * @var ParagonIE_Sodium_Core32_Curve25519_Fe
     */
    public $yplusx;

    /**
     * @var ParagonIE_Sodium_Core32_Curve25519_Fe
     */
    public $yminusx;

    /**
     * @var ParagonIE_Sodium_Core32_Curve25519_Fe
     */
    public $xy2d;

    /**
     * ParagonIE_Sodium_Core32_Curve25519_Ge_Precomp constructor.
     *
     * @param ParagonIE_Sodium_Core32_Curve25519_Fe $yplusx
     * @param ParagonIE_Sodium_Core32_Curve25519_Fe $yminusx
     * @param ParagonIE_Sodium_Core32_Curve25519_Fe $xy2d
     * @throws SodiumException
     * @throws TypeError
     * @internal You should not use this directly from another application
     *
     */
    public function __construct(
        ParagonIE_Sodium_Core32_Curve25519_Fe $yplusx = null,
        ParagonIE_Sodium_Core32_Curve25519_Fe $yminusx = null,
        ParagonIE_Sodium_Core32_Curve25519_Fe $xy2d = null
    )
    {
        if ($yplusx === null) {
            $yplusx = ParagonIE_Sodium_Core32_Curve25519::fe_0();
        }
        $this->yplusx = $yplusx;
        if ($yminusx === null) {
            $yminusx = ParagonIE_Sodium_Core32_Curve25519::fe_0();
        }
        $this->yminusx = $yminusx;
        if ($xy2d === null) {
            $xy2d = ParagonIE_Sodium_Core32_Curve25519::fe_0();
        }
        $this->xy2d = $xy2d;
    }
}
