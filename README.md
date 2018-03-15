# Email Builder

Drag'n'drop email builder.

![email-builder-ui](https://user-images.githubusercontent.com/10295466/37458623-a03b9c4c-2856-11e8-9061-c8e126937729.png)

### Features

- Drag'n'drop UI;
- Adopted for 3rd-party templates;
- Image uploader and cropper;
- Inline content editor;
- Code editor;
- Template export (HTML/ZIP);
- Template test sending via SMTP;
- Developer-friendly (SASS + NPM);


## Development
The package is based on [Laravel Mix](https://github.com/JeffreyWay/laravel-mix).
### Installation
```
git clone
npm install
npm run watch
```
### Available NPM commands
```
npm run watch
npm run dev
npm run production
```

**IMPORTANT:** 

Your application should be running over secure connection (HTTPS). 

Do not forget to replace all occurrences of ``localhost`` to the actual domain name of your app.

Do not forget to update ``/server/_config.php``. Files ``_export.php`` and ``async.php`` also contain application-specific variables like path to the uploads folder and path to the template.

## Changelog
```
v1.0.0 - March 15, 2018
** Initial release **
```

## Credits
- [Max Kostinevich](https://maxkostinevich.com)

## [MIT License](https://opensource.org/licenses/MIT)
(c) 2018  [DigitalWheat](https://digitalwheat.com) - All rights reserved.

## About
At [DigitalWheat](https://digitalwheat.com) we create modern web-applications for small and medium-sized business. 

**Have a project in mind? [Let's talk!](https://digitalwheat.com/get-quote)**
