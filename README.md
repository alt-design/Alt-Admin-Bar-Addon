# Alt Admin Bar Addon

> Quick links to the control panel, edit current page, cache pages, other gubbins. Kinda extendable 👀

## How to Install

You can search for this addon in the `Tools > Addons` section of the Statamic control panel and click **install**, or run the following command from your project root:

``` bash
composer require alt-design/alt-admin-bar
```

## Basic Use

Just slap this in your layout, as Todd Howard says, it should ✨Just Work™ ✨ 

```
{{ alt_admin_bar }}
```

## Extending The Bar

We got a lil' event listener when the menu is created, this allows you to add to the menu as you fancy - usage is below:

```
use AltDesign\AltAdminBar\DTO\MenuItemDTO;

Illuminate\Support\Facades\Event::listen('alt_admin_menu_items', function ($menuItems) {
    
    // Standard link w/ url
    $menuItems[] = MenuItemDTO::make([
        'title' => 'Simple Title',
        'href' => '/simple-link',
    ]);
    
    // Item with Children
    $menuItems[] = MenuItemDTO::make([
        'title' => 'Simple Title With Children',
        'href' => '/simple-title-with-children',
        'children' => [
            MenuItemDTO::make([
                'title' => 'Simple Child',
                'href' => '/simple-child',
            ]),
            MenuItemDTO::make([
                'title' => 'Simple Child ',
                'href' => '/simple-child-2',
            ])
        ]
    ]);
    
    return $menuItems;
    
});
```


## Questions etc

Drop us a big shout-out if you have any questions, comments, or concerns. We're always looking to improve our addons, so if you have any feature requests, we'd love to hear them.

### Starter Kits
- [Alt Starter Kit](https://statamic.com/starter-kits/alt-design/alt-starter-kit)

### Addons
- [Alt Redirect Addon](https://github.com/alt-design/Alt-Redirect-Addon)
- [Alt Sitemap Addon](https://github.com/alt-design/Alt-Sitemap-Addon)
- [Alt Akismet Addon](https://github.com/alt-design/Alt-Akismet-Addon)
- [Alt Password Protect Addon](https://github.com/alt-design/Alt-Password-Protect-Addon)
- [Alt Cookies Addon](https://github.com/alt-design/Alt-Cookies-Addon)
- [Alt Inbound Addon](https://github.com/alt-design/Alt-Inbound-Addon)
- [Alt Google 2FA Addon](https://github.com/alt-design/Alt-Google-2fa-Addon)

## Postcardware

Send us a postcard from your hometown if you like this addon. We love getting mail from other cool peeps!

Alt Design  
St Helens House
Derby  
DE1 3EE
UK  

