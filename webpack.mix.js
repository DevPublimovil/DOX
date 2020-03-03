const mix = require('laravel-mix');
const path        = require('path');
const _           = require('lodash');

Mix.listen('loading-rules', function (rules) {
  var index = _.findIndex(rules, (rule) => {
    return /\(\?\!font\)\./.test(rule.test.toString());
  }), regex;

  if (index >= 0) {
    regex = rules[index].test.source.replace("!font", "!font|svg");
    rules[index].test = new RegExp(regex);
  }
});
/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.js('resources/js/app.js', 'public/js')
   .sass('resources/sass/app.scss', 'public/css')
   .options({
      processCssUrls: false,
      vue: {
        transformToRequire: {
          "svg-icon": 'src',
          img:        'src',
          image:      'xlink:href'
        }
      }
    })
   .webpackConfig({
      resolve: {
        alias: {
         "@":       path.resolve(__dirname, "resources/assets/js"),
         "@images": path.resolve(__dirname, "public"),
          '@svg':    path.resolve(__dirname, 'resources/js/svg'),
        }
      },
      module: {
        rules: [
          {
            test:   /\.svg$/,
            loader: 'svg-inline-loader?removeSVGTagAttrs=false'
          }
        ]
      }
    });
