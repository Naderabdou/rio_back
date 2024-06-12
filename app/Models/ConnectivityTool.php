<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConnectivityTool extends Model
{
    use HasFactory;

    protected $fillable = [
        'key',
        'nickname',
        'tool_id',
        'enabled'
    ];

    public static function toolScript($key)
    {
        switch ($key) {
            case 'facebook_pixel':
                $ID = self::where('key', $key)->first()->tool_id;

                return <<<HTML
                <script>
                  !function(f,b,e,v,n,t,s)
                  {if(f.fbq)return;n=f.fbq=function(){n.callMethod?
                  n.callMethod.apply(n,arguments):n.queue.push(arguments)};
                  if(!f._fbq)f._fbq=n;n.push=n;n.loaded=!0;n.version='2.0';
                  n.queue=[];t=b.createElement(e);t.async=!0;
                  t.src=v;s=b.getElementsByTagName(e)[0];
                  s.parentNode.insertBefore(t,s)}(window, document,'script',
                  'https://connect.facebook.net/en_US/fbevents.js');
                  fbq('init', "{$ID}");
                  fbq('track', 'PageView');
                </script>
                <noscript>
                  <img height="1" width="1" style="display:none"
                       src="https://www.facebook.com/tr?id={$ID}&ev=PageView&noscript=1"/>
                </noscript>
                HTML;
                break;

            case 'google_tag':
                $ID = self::where('key', $key)->first()->tool_id;

                return <<<HTML
                <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
                new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
                j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
                'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
                })(window,document,'script','dataLayer', "{$ID}");</script>
                HTML;

                break;

            case 'tawk':
                $ID = self::where('key', $key)->first()->tool_id;

                return <<<HTML
                    <script type="text/javascript">
                        (function() {
                            function async_load() {
                                var bt_ads = document.createElement('script');
                                bt_ads.setAttribute("async", true);
                                bt_ads.setAttribute("type", 'text/javascript');
                                bt_ads.src =
                                    "https://bot.surbo.io/static/1.0.1/js/custom/widget_surbo.js?id={$ID}&srb_1=&srb_2=&srb_3=";
                                var node = document.getElementsByTagName('script')[0];
                                node.parentNode.insertBefore(bt_ads, node);
                            }
                            if (window.attachEvent)
                                window.attachEvent('onload', async_load);
                            else
                                window.addEventListener('load', async_load, false);
                        })();
                    </script>
                    HTML;

                break;

            default:
                return 'not supported key';
                break;
        }
    }
}
