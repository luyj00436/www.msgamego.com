<style type="text/css">
    div[id^="wpfc-modal-disablewpcron"] .wiz-input-cont {
        margin-top: 0 !important;
        margin-bottom: 5px !important;
        float: left !important;
        width: 40% !important;
    }

    .wiz-input-cont label {
        margin-right: 0 !important;
    }
</style>
<div template-id="wpfc-modal-disablewpcron"
     style="display:none;top: 10.5px; left: 226px; position: absolute; padding: 6px; height: auto; width: 300px; z-index: 10001;">
    <div style="height: 100%; width: 100%; background: none repeat scroll 0% 0% rgb(0, 0, 0); position: absolute; top: 0px; left: 0px; z-index: -1; opacity: 0.5; border-radius: 8px;">
    </div>
    <div style="z-index: 600; border-radius: 3px;">
        <div style="font-family:Verdana,Geneva,Arial,Helvetica,sans-serif;font-size:12px;background: none repeat scroll 0px 0px rgb(255, 161, 0); z-index: 1000; position: relative; padding: 2px; border-bottom: 1px solid rgb(194, 122, 0); height: 35px; border-radius: 3px 3px 0px 0px;">
            <table width="100%" height="100%">
                <tbody>
                <tr>
                    <td valign="middle"
                        style="vertical-align: middle; font-weight: bold; color: rgb(255, 255, 255); text-shadow: 0px 1px 1px rgba(0, 0, 0, 0.5); padding-left: 10px; font-size: 13px; cursor: move;"><?php _e("Warning", "wp-fastest-cache"); ?></td>
                    <td width="20" align="center" style="vertical-align: middle;"></td>
                    <td width="20" align="center"
                        style="vertical-align: middle; font-family: Arial,Helvetica,sans-serif; color: rgb(170, 170, 170); cursor: default;">
                        <div title="Close Window" class="close-wiz"></div>
                    </td>
                </tr>
                </tbody>
            </table>
        </div>
        <div class="window-content-wrapper" style="padding: 15px;">
            <div class="window-content"
                 style="z-index: 1000; height: auto; position: relative; display: inline-block; width: 100%;">

                <div class="wpfc-cdn-pages-container">
                    <div class="wiz-cont" style="padding: 10px !important">
                        <h1>Disabled Cron</h1>
                        <p>The Cron has been disabled entirely by setting <b><a
                                        href="https://codex.wordpress.org/Editing_wp-config.php#Disable_Cron_and_Cron_Timeout"
                                        target="_blank">DISABLE_WP_CRON</a></b> to true.</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="window-buttons-wrapper"
             style="padding: 0px; display: inline-block; width: 100%; border-top: 1px solid rgb(255, 255, 255); background: none repeat scroll 0px 0px rgb(222, 222, 222); z-index: 999; position: relative; text-align: right; border-radius: 0px 0px 3px 3px;">
            <div style="padding: 12px; height: 23px;text-align: center;">
                <button class="wpfc-dialog-buttons buttons" type="button" action="close">
                    <span>OK</span>
                </button>
            </div>
        </div>
    </div>
</div>