const autoprefixer = require('autoprefixer');
const webpack = require('webpack');
const path = require('path');
const precss = require('precss');
const BrowserSyncPlugin = require('browser-sync-webpack-plugin');

module.exports = {
  devtool: 'eval',
  entry: [
    'tether',
    'popper.js',
    'font-awesome/scss/font-awesome.scss',
    './src/scss/main.scss',
    './src/js/app.js'
  ],
  plugins: [
    new webpack.ProvidePlugin({
      '$': 'jqeury',
      jQuery: 'jquery',
      Teher: 'tether',
      Popper: ['popper.js', 'default'],
    }),
    new BrowserSyncPlugin({
      host: 'localhost',
      port: 3000,
      proxy: 'http://localhost:8000/tj_project/',
      files: [
        {
          match: [
            '**/*.php',
            '**/*.scss',
            '**/*.js'
          ]
        }
      ]
    }, { reload: false })
  ],
  output: {
    filename: 'bundle.js'
  },
  module: {
    rules: [
      {
        test: /\.css$/,
        use: ["style-loader", "css-loader", "postcss-loader"]
      },
      {
        test: /\.(scss)$/,
        use: [
          {
            loader: 'style-loader',
          },
          {
            loader: 'css-loader',
          },
          {
            loader: 'postcss-loader',
            options: {
              plugins: function () {
                return [
                  precss,
                  autoprefixer
                ];
              }
            }
          },
          {
            loader: 'sass-loader'
          }
        ]
      },
      {
        test: /\.woff2?(\?v=[0-9]\.[0-9]\.[0-9])?$/,
        use: 'url-loader?limit=10000&name=./dist/webfonts/[name].[ext]',
      },
      {
        test: /\.(ttf|eot|svg)(\?[\s\S]+)?$/,
        use: 'file-loader?name=./dist/webfonts/[name].[ext]',
      },
      {
        test: /\.(jpe?g|png|gif|svg)$/i,
        use: [
          'file-loader?name=images/[name].[ext]',
          'image-webpack-loader?bypassOnDebug'
        ]
      },
      {
        test: /font-awesome\.config\.js/,
        use: [
          { loader: 'style-loader' },
          { loader: 'font-awesome-loader' }
        ]
      },
      {
        test: /bootstrap\/dist\/js\/umd\//, 
        use: 'imports-loader?jQuery=jquery'
      }
    ]
  }
};
