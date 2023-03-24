<?php
/**
 * List Table API: WP_MS_Sites_List_Table class
 *
 * @package WordPress
 * @subpackage Administration
 * @since 3.1.0
 */

/**
 * Core class used to implement displaying sites in a list table for the network admin.
 *
 * @since 3.1.0
 *
 * @see WP_List_Table
 */
class WP_MS_Sites_List_Table extends WP_List_Table
{

    /**
     * Site status list.
     *
     * @since 4.3.0
     * @var array
     */
    public $status_list;

    /**
     * Constructor.
     *
     * @param array $args An associative array of arguments.
     * @see WP_List_Table::__construct() for more information on default arguments.
     *
     * @since 3.1.0
     *
     */
    public function __construct($args = array())
    {
        $this->status_list = array(
            'archived' => array('site-archived', __('Archived')),
            'spam' => array('site-spammed', _x('Spam', 'site')),
            'deleted' => array('site-deleted', __('Deleted')),
            'mature' => array('site-mature', __('Mature')),
        );

        parent::__construct(
            array(
                'plural' => 'sites',
                'screen' => isset($args['screen']) ? $args['screen'] : null,
            )
        );
    }

    /**
     * @return bool
     */
    public function ajax_user_can()
    {
        return current_user_can('manage_sites');
    }

    /**
     * Prepares the list of sites for display.
     *
     * @since 3.1.0
     *
     * @global string $mode List table view mode.
     * @global string $s
     * @global wpdb $wpdb WordPress database abstraction object.
     */
    public function prepare_items()
    {
        global $mode, $s, $wpdb;

        if (!empty($_REQUEST['mode'])) {
            $mode = 'excerpt' === $_REQUEST['mode'] ? 'excerpt' : 'list';
            set_user_setting('sites_list_mode', $mode);
        } else {
            $mode = get_user_setting('sites_list_mode', 'list');
        }

        $per_page = $this->get_items_per_page('sites_network_per_page');

        $pagenum = $this->get_pagenum();

        $s = isset($_REQUEST['s']) ? wp_unslash(trim($_REQUEST['s'])) : '';
        $wild = '';
        if (false !== strpos($s, '*')) {
            $wild = '*';
            $s = trim($s, '*');
        }

        /*
         * If the network is large and a search is not being performed, show only
         * the latest sites with no paging in order to avoid expensive count queries.
         */
        if (!$s && wp_is_large_network()) {
            if (!isset($_REQUEST['orderby'])) {
                $_GET['orderby'] = '';
                $_REQUEST['orderby'] = '';
            }
            if (!isset($_REQUEST['order'])) {
                $_GET['order'] = 'DESC';
                $_REQUEST['order'] = 'DESC';
            }
        }

        $args = array(
            'number' => (int)$per_page,
            'offset' => (int)(($pagenum - 1) * $per_page),
            'network_id' => get_current_network_id(),
        );

        if (empty($s)) {
            // Nothing to do.
        } elseif (preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}$/', $s) ||
            preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.[0-9]{1,3}\.?$/', $s) ||
            preg_match('/^[0-9]{1,3}\.[0-9]{1,3}\.?$/', $s) ||
            preg_match('/^[0-9]{1,3}\.$/', $s)) {
            // IPv4 address.
            $sql = $wpdb->prepare("SELECT blog_id FROM {$wpdb->registration_log} WHERE {$wpdb->registration_log}.IP LIKE %s", $wpdb->esc_like($s) . (!empty($wild) ? '%' : ''));
            $reg_blog_ids = $wpdb->get_col($sql);

            if ($reg_blog_ids) {
                $args['site__in'] = $reg_blog_ids;
            }
        } elseif (is_numeric($s) && empty($wild)) {
            $args['ID'] = $s;
        } else {
            $args['search'] = $s;

            if (!is_subdomain_install()) {
                $args['search_columns'] = array('path');
            }
        }

        $order_by = isset($_REQUEST['orderby']) ? $_REQUEST['orderby'] : '';
        if ('registered' === $order_by) {
            // 'registered' is a valid field name.
        } elseif ('lastupdated' === $order_by) {
            $order_by = 'last_updated';
        } elseif ('blogname' === $order_by) {
            if (is_subdomain_install()) {
                $order_by = 'domain';
            } else {
                $order_by = 'path';
            }
        } elseif ('blog_id' === $order_by) {
            $order_by = 'id';
        } elseif (!$order_by) {
            $order_by = false;
        }

        $args['orderby'] = $order_by;

        if ($order_by) {
            $args['order'] = (isset($_REQUEST['order']) && 'DESC' === strtoupper($_REQUEST['order'])) ? 'DESC' : 'ASC';
        }

        if (wp_is_large_network()) {
            $args['no_found_rows'] = true;
        } else {
            $args['no_found_rows'] = false;
        }

        // Take into account the role the user has selected.
        $status = isset($_REQUEST['status']) ? wp_unslash(trim($_REQUEST['status'])) : '';
        if (in_array($status, array('public', 'archived', 'mature', 'spam', 'deleted'), true)) {
            $args[$status] = 1;
        }

        /**
         * Filters the arguments for the site query in the sites list table.
         *
         * @param array $args An array of get_sites() arguments.
         * @since 4.6.0
         *
         */
        $args = apply_filters('ms_sites_list_table_query_args', $args);

        $_sites = get_sites($args);
        if (is_array($_sites)) {
            update_site_cache($_sites);

            $this->items = array_slice($_sites, 0, $per_page);
        }

        $total_sites = get_sites(
            array_merge(
                $args,
                array(
                    'count' => true,
                    'offset' => 0,
                    'number' => 0,
                )
            )
        );

        $this->set_pagination_args(
            array(
                'total_items' => $total_sites,
                'per_page' => $per_page,
            )
        );
    }

    /**
     */
    public function no_items()
    {
        _e('No sites found.');
    }

    /**
     * @return array
     */
    public function get_columns()
    {
        $sites_columns = array(
            'cb' => '<input type="checkbox" />',
            'blogname' => __('URL'),
            'lastupdated' => __('Last Updated'),
            'registered' => _x('Registered', 'site'),
            'users' => __('Users'),
        );

        if (has_filter('wpmublogsaction')) {
            $sites_columns['plugins'] = __('Actions');
        }

        /**
         * Filters the displayed site columns in Sites list table.
         *
         * @param string[] $sites_columns An array of displayed site columns. Default 'cb',
         *                               'blogname', 'lastupdated', 'registered', 'users'.
         * @since MU (3.0.0)
         *
         */
        return apply_filters('wpmu_blogs_columns', $sites_columns);
    }

    /**
     * Handles the checkbox column output.
     *
     * @param array $item Current site.
     * @since 5.9.0 Renamed `$blog` to `$item` to match parent class for PHP 8 named parameter support.
     *
     * @since 4.3.0
     */
    public function column_cb($item)
    {
        // Restores the more descriptive, specific name for use within this method.
        $blog = $item;

        if (!is_main_site($blog['blog_id'])) :
            $blogname = untrailingslashit($blog['domain'] . $blog['path']);
            ?>
            <label class="screen-reader-text" for="blog_<?php echo $blog['blog_id']; ?>">
                <?php
                /* translators: %s: Site URL. */
                printf(__('Select %s'), $blogname);
                ?>
            </label>
            <input type="checkbox" id="blog_<?php echo $blog['blog_id']; ?>" name="allblogs[]"
                   value="<?php echo esc_attr($blog['blog_id']); ?>"/>
        <?php
        endif;
    }

    /**
     * Handles the ID column output.
     *
     * @param array $blog Current site.
     * @since 4.4.0
     *
     */
    public function column_id($blog)
    {
        echo $blog['blog_id'];
    }

    /**
     * Handles the site name column output.
     *
     * @param array $blog Current site.
     * @global string $mode List table view mode.
     *
     * @since 4.3.0
     *
     */
    public function column_blogname($blog)
    {
        global $mode;

        $blogname = untrailingslashit($blog['domain'] . $blog['path']);

        ?>
        <strong>
            <a href="<?php echo esc_url(network_admin_url('site-info.php?id=' . $blog['blog_id'])); ?>"
               class="edit"><?php echo $blogname; ?></a>
            <?php $this->site_states($blog); ?>
        </strong>
        <?php
        if ('list' !== $mode) {
            switch_to_blog($blog['blog_id']);
            echo '<p>';
            printf(
            /* translators: 1: Site title, 2: Site tagline. */
                __('%1$s &#8211; %2$s'),
                get_option('blogname'),
                '<em>' . get_option('blogdescription') . '</em>'
            );
            echo '</p>';
            restore_current_blog();
        }
    }

    /**
     * Maybe output comma-separated site states.
     *
     * @param array $site
     * @since 5.3.0
     *
     */
    protected function site_states($site)
    {
        $site_states = array();

        // $site is still an array, so get the object.
        $_site = WP_Site::get_instance($site['blog_id']);

        if (is_main_site($_site->id)) {
            $site_states['main'] = __('Main');
        }

        reset($this->status_list);

        $site_status = isset($_REQUEST['status']) ? wp_unslash(trim($_REQUEST['status'])) : '';
        foreach ($this->status_list as $status => $col) {
            if ((1 === (int)$_site->{$status}) && ($site_status !== $status)) {
                $site_states[$col[0]] = $col[1];
            }
        }

        /**
         * Filters the default site display states for items in the Sites list table.
         *
         * @param string[] $site_states An array of site states. Default 'Main',
         *                              'Archived', 'Mature', 'Spam', 'Deleted'.
         * @param WP_Site $site The current site object.
         * @since 5.3.0
         *
         */
        $site_states = apply_filters('display_site_states', $site_states, $_site);

        if (!empty($site_states)) {
            $state_count = count($site_states);

            $i = 0;

            echo ' &mdash; ';

            foreach ($site_states as $state) {
                ++$i;

                $separator = ($i < $state_count) ? ', ' : '';

                echo "<span class='post-state'>{$state}{$separator}</span>";
            }
        }
    }

    /**
     * Handles the lastupdated column output.
     *
     * @param array $blog Current site.
     * @global string $mode List table view mode.
     *
     * @since 4.3.0
     *
     */
    public function column_lastupdated($blog)
    {
        global $mode;

        if ('list' === $mode) {
            $date = __('Y/m/d');
        } else {
            $date = __('Y/m/d g:i:s a');
        }

        echo ('0000-00-00 00:00:00' === $blog['last_updated']) ? __('Never') : mysql2date($date, $blog['last_updated']);
    }

    /**
     * Handles the registered column output.
     *
     * @param array $blog Current site.
     * @global string $mode List table view mode.
     *
     * @since 4.3.0
     *
     */
    public function column_registered($blog)
    {
        global $mode;

        if ('list' === $mode) {
            $date = __('Y/m/d');
        } else {
            $date = __('Y/m/d g:i:s a');
        }

        if ('0000-00-00 00:00:00' === $blog['registered']) {
            echo '&#x2014;';
        } else {
            echo mysql2date($date, $blog['registered']);
        }
    }

    /**
     * Handles the users column output.
     *
     * @param array $blog Current site.
     * @since 4.3.0
     *
     */
    public function column_users($blog)
    {
        $user_count = wp_cache_get($blog['blog_id'] . '_user_count', 'blog-details');
        if (!$user_count) {
            $blog_users = new WP_User_Query(
                array(
                    'blog_id' => $blog['blog_id'],
                    'fields' => 'ID',
                    'number' => 1,
                    'count_total' => true,
                )
            );
            $user_count = $blog_users->get_total();
            wp_cache_set($blog['blog_id'] . '_user_count', $user_count, 'blog-details', 12 * HOUR_IN_SECONDS);
        }

        printf(
            '<a href="%s">%s</a>',
            esc_url(network_admin_url('site-users.php?id=' . $blog['blog_id'])),
            number_format_i18n($user_count)
        );
    }

    /**
     * Handles the plugins column output.
     *
     * @param array $blog Current site.
     * @since 4.3.0
     *
     */
    public function column_plugins($blog)
    {
        if (has_filter('wpmublogsaction')) {
            /**
             * Fires inside the auxiliary 'Actions' column of the Sites list table.
             *
             * By default this column is hidden unless something is hooked to the action.
             *
             * @param int $blog_id The site ID.
             * @since MU (3.0.0)
             *
             */
            do_action('wpmublogsaction', $blog['blog_id']);
        }
    }

    /**
     * Handles output for the default column.
     *
     * @param array $item Current site.
     * @param string $column_name Current column name.
     * @since 4.3.0
     * @since 5.9.0 Renamed `$blog` to `$item` to match parent class for PHP 8 named parameter support.
     *
     */
    public function column_default($item, $column_name)
    {
        /**
         * Fires for each registered custom column in the Sites list table.
         *
         * @param string $column_name The name of the column to display.
         * @param int $blog_id The site ID.
         * @since 3.1.0
         *
         */
        do_action('manage_sites_custom_column', $column_name, $item['blog_id']);
    }

    /**
     * @global string $mode List table view mode.
     */
    public function display_rows()
    {
        foreach ($this->items as $blog) {
            $blog = $blog->to_array();
            $class = '';
            reset($this->status_list);

            foreach ($this->status_list as $status => $col) {
                if (1 == $blog[$status]) {
                    $class = " class='{$col[0]}'";
                }
            }

            echo "<tr{$class}>";

            $this->single_row_columns($blog);

            echo '</tr>';
        }
    }

    /**
     * Gets links to filter sites by status.
     *
     * @return array
     * @since 5.3.0
     *
     */
    protected function get_views()
    {
        $counts = wp_count_sites();

        $statuses = array(
            /* translators: %s: Number of sites. */
            'all' => _nx_noop(
                'All <span class="count">(%s)</span>',
                'All <span class="count">(%s)</span>',
                'sites'
            ),

            /* translators: %s: Number of sites. */
            'public' => _n_noop(
                'Public <span class="count">(%s)</span>',
                'Public <span class="count">(%s)</span>'
            ),

            /* translators: %s: Number of sites. */
            'archived' => _n_noop(
                'Archived <span class="count">(%s)</span>',
                'Archived <span class="count">(%s)</span>'
            ),

            /* translators: %s: Number of sites. */
            'mature' => _n_noop(
                'Mature <span class="count">(%s)</span>',
                'Mature <span class="count">(%s)</span>'
            ),

            /* translators: %s: Number of sites. */
            'spam' => _nx_noop(
                'Spam <span class="count">(%s)</span>',
                'Spam <span class="count">(%s)</span>',
                'sites'
            ),

            /* translators: %s: Number of sites. */
            'deleted' => _n_noop(
                'Deleted <span class="count">(%s)</span>',
                'Deleted <span class="count">(%s)</span>'
            ),
        );

        $view_links = array();
        $requested_status = isset($_REQUEST['status']) ? wp_unslash(trim($_REQUEST['status'])) : '';
        $url = 'sites.php';

        foreach ($statuses as $status => $label_count) {
            if ((int)$counts[$status] > 0) {
                $label = sprintf(translate_nooped_plural($label_count, $counts[$status]), number_format_i18n($counts[$status]));
                $full_url = 'all' === $status ? $url : add_query_arg('status', $status, $url);

                $view_links[$status] = array(
                    'url' => esc_url($full_url),
                    'label' => $label,
                    'current' => $requested_status === $status || ('' === $requested_status && 'all' === $status),
                );
            }
        }

        return $this->get_views_links($view_links);
    }

    /**
     * @return array
     */
    protected function get_bulk_actions()
    {
        $actions = array();
        if (current_user_can('delete_sites')) {
            $actions['delete'] = __('Delete');
        }
        $actions['spam'] = _x('Mark as spam', 'site');
        $actions['notspam'] = _x('Not spam', 'site');

        return $actions;
    }

    /**
     * @param string $which The location of the pagination nav markup: 'top' or 'bottom'.
     * @global string $mode List table view mode.
     *
     */
    protected function pagination($which)
    {
        global $mode;

        parent::pagination($which);

        if ('top' === $which) {
            $this->view_switcher($mode);
        }
    }

    /**
     * Extra controls to be displayed between bulk actions and pagination.
     *
     * @param string $which The location of the extra table nav markup: 'top' or 'bottom'.
     * @since 5.3.0
     *
     */
    protected function extra_tablenav($which)
    {
        ?>
        <div class="alignleft actions">
            <?php
            if ('top' === $which) {
                ob_start();

                /**
                 * Fires before the Filter button on the MS sites list table.
                 *
                 * @param string $which The location of the extra table nav markup: 'top' or 'bottom'.
                 * @since 5.3.0
                 *
                 */
                do_action('restrict_manage_sites', $which);

                $output = ob_get_clean();

                if (!empty($output)) {
                    echo $output;
                    submit_button(__('Filter'), '', 'filter_action', false, array('id' => 'site-query-submit'));
                }
            }
            ?>
        </div>
        <?php
        /**
         * Fires immediately following the closing "actions" div in the tablenav for the
         * MS sites list table.
         *
         * @param string $which The location of the extra table nav markup: 'top' or 'bottom'.
         * @since 5.3.0
         *
         */
        do_action('manage_sites_extra_tablenav', $which);
    }

    /**
     * @return array
     */
    protected function get_sortable_columns()
    {
        return array(
            'blogname' => 'blogname',
            'lastupdated' => 'lastupdated',
            'registered' => 'blog_id',
        );
    }

    /**
     * Gets the name of the default primary column.
     *
     * @return string Name of the default primary column, in this case, 'blogname'.
     * @since 4.3.0
     *
     */
    protected function get_default_primary_column_name()
    {
        return 'blogname';
    }

    /**
     * Generates and displays row action links.
     *
     * @param array $item Site being acted upon.
     * @param string $column_name Current column name.
     * @param string $primary Primary column name.
     * @return string Row actions output for sites in Multisite, or an empty string
     *                if the current column is not the primary column.
     * @since 4.3.0
     * @since 5.9.0 Renamed `$blog` to `$item` to match parent class for PHP 8 named parameter support.
     *
     */
    protected function handle_row_actions($item, $column_name, $primary)
    {
        if ($primary !== $column_name) {
            return '';
        }

        // Restores the more descriptive, specific name for use within this method.
        $blog = $item;
        $blogname = untrailingslashit($blog['domain'] . $blog['path']);

        // Preordered.
        $actions = array(
            'edit' => '',
            'backend' => '',
            'activate' => '',
            'deactivate' => '',
            'archive' => '',
            'unarchive' => '',
            'spam' => '',
            'unspam' => '',
            'delete' => '',
            'visit' => '',
        );

        $actions['edit'] = '<a href="' . esc_url(network_admin_url('site-info.php?id=' . $blog['blog_id'])) . '">' . __('Edit') . '</a>';
        $actions['backend'] = "<a href='" . esc_url(get_admin_url($blog['blog_id'])) . "' class='edit'>" . __('Dashboard') . '</a>';
        if (get_network()->site_id != $blog['blog_id']) {
            if ('1' == $blog['deleted']) {
                $actions['activate'] = '<a href="' . esc_url(wp_nonce_url(network_admin_url('sites.php?action=confirm&amp;action2=activateblog&amp;id=' . $blog['blog_id']), 'activateblog_' . $blog['blog_id'])) . '">' . __('Activate') . '</a>';
            } else {
                $actions['deactivate'] = '<a href="' . esc_url(wp_nonce_url(network_admin_url('sites.php?action=confirm&amp;action2=deactivateblog&amp;id=' . $blog['blog_id']), 'deactivateblog_' . $blog['blog_id'])) . '">' . __('Deactivate') . '</a>';
            }

            if ('1' == $blog['archived']) {
                $actions['unarchive'] = '<a href="' . esc_url(wp_nonce_url(network_admin_url('sites.php?action=confirm&amp;action2=unarchiveblog&amp;id=' . $blog['blog_id']), 'unarchiveblog_' . $blog['blog_id'])) . '">' . __('Unarchive') . '</a>';
            } else {
                $actions['archive'] = '<a href="' . esc_url(wp_nonce_url(network_admin_url('sites.php?action=confirm&amp;action2=archiveblog&amp;id=' . $blog['blog_id']), 'archiveblog_' . $blog['blog_id'])) . '">' . _x('Archive', 'verb; site') . '</a>';
            }

            if ('1' == $blog['spam']) {
                $actions['unspam'] = '<a href="' . esc_url(wp_nonce_url(network_admin_url('sites.php?action=confirm&amp;action2=unspamblog&amp;id=' . $blog['blog_id']), 'unspamblog_' . $blog['blog_id'])) . '">' . _x('Not Spam', 'site') . '</a>';
            } else {
                $actions['spam'] = '<a href="' . esc_url(wp_nonce_url(network_admin_url('sites.php?action=confirm&amp;action2=spamblog&amp;id=' . $blog['blog_id']), 'spamblog_' . $blog['blog_id'])) . '">' . _x('Spam', 'site') . '</a>';
            }

            if (current_user_can('delete_site', $blog['blog_id'])) {
                $actions['delete'] = '<a href="' . esc_url(wp_nonce_url(network_admin_url('sites.php?action=confirm&amp;action2=deleteblog&amp;id=' . $blog['blog_id']), 'deleteblog_' . $blog['blog_id'])) . '">' . __('Delete') . '</a>';
            }
        }

        $actions['visit'] = "<a href='" . esc_url(get_home_url($blog['blog_id'], '/')) . "' rel='bookmark'>" . __('Visit') . '</a>';

        /**
         * Filters the action links displayed for each site in the Sites list table.
         *
         * The 'Edit', 'Dashboard', 'Delete', and 'Visit' links are displayed by
         * default for each site. The site's status determines whether to show the
         * 'Activate' or 'Deactivate' link, 'Unarchive' or 'Archive' links, and
         * 'Not Spam' or 'Spam' link for each site.
         *
         * @param string[] $actions An array of action links to be displayed.
         * @param int $blog_id The site ID.
         * @param string $blogname Site path, formatted depending on whether it is a sub-domain
         *                           or subdirectory multisite installation.
         * @since 3.1.0
         *
         */
        $actions = apply_filters('manage_sites_action_links', array_filter($actions), $blog['blog_id'], $blogname);

        return $this->row_actions($actions);
    }
}