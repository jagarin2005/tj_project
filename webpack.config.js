'use strict';
const webpack = require('webpack');
const path = require('path');
const precss = require('precss');
const autoprefixer = require('autoprefixer');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

module.exports = {
  'entry': [
    'font-awesome/scss/font-awesome.scss',
    './src/scss/main.scss',
    './src/js/app.js'
  ],
  'plugins': [
    new webpack.ProvidePlugin({
      '$': 'jquery',
      'jQuery': 'jquery',
      'window.$': 'jquery',
      'window.jQuery': 'jquery',
      'global.$': 'jquery',
      'global.jQuery': 'jquery',
      'Popper': ['popper.js', 'default'],
    }),
    new BrowserSyncPlugin({
      'host': 'localhost',
      'port': 3000,
      'proxy': 'http://localhost:8000/tj_project/',
      'files': [
        {
          'match': [
            '**/*.php',
            '**/*.scss',
            '**/*.js'
          ]
        }
      ]
    }, { 'reload': false }),
    // new webpack.optimize.UglifyJsPlugin
  ],
  'output': {
    'filename': 'bundle.js'
  },
  'devtool': '#eval-source-map',
  'module': {
    'rules': [
      {
        'test': /\.css$/,
        'use': [{
          'loader': 'style-loader',
        },
        {
          'loader': 'css-loader',
        },
        {
          'loader': 'postcss-loader',
          'options': {
            'plugins': function () {
              return [
                precss,
                autoprefixer
              ];
            }
          }
        }]
      },
      {
        'test': /\.(scss)$/,
        'use': [
          {
            'loader': 'style-loader',
          },
          {
            'loader': 'css-loader',
          },
          {
            'loader': 'postcss-loader',
            'options': {
              'plugins': function () {
                return [
                  precss,
                  autoprefixer
                ];
              }
            }
          },
          {
            'loader': 'sass-loader'
          }
        ]
      },
      {
        'test': /\.woff2?(\?v=[0-9]\.[0-9]\.[0-9])?$/,
        'use': 'url-loader?limit=10000&name=./dist/webfonts/[name].[ext]',
      },
      {
        'test': /\.(ttf|eot|svg)(\?[\s\S]+)?$/,
        'use': 'file-loader?name=./dist/webfonts/[name].[ext]',
      },
      {
        'test': /\.(jpe?g|png|gif|svg)$/i,
        'use': [
          'file-loader?name=images/[name].[ext]',
          'image-webpack-loader?bypassOnDebug'
        ]
      },
      {
        'test': /font-awesome\.config\.js/,
        'use': [
          { 'loader': 'style-loader' },
          { 'loader': 'font-awesome-loader' }
        ]
      },
      {
        'test': /bootstrap\/dist\/js\/umd\//, 
        'use': 'imports-loader?$=jquery'
      },
      {
        'test': /\.js$/,
        'loader': 'babel-loader',
        'exclude': /node_modules/,
        'query': {
          'presets': ['es2015']
        },
      }
    ]
  }
};

if (process.env.NODE_ENV === 'production') {
  module.exports.devtool = '#source-map',
  module.exports.plugins = (module.exports.plugins || []).concat([
    new webpack.DefinePlugin({
      'process.env': {
        NODE_ENV: '"production"'
      }
    }),
    new webpack.optimize.UglifyJsPlugin({
      sourceMap: true,
      compress: {
        warnings: false
      }
    }),
    new webpack.LoaderOptionsPlugin({
      minimize: true
    })
  ])
}