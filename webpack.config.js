const path = require( 'path' )
const webpack = require( 'webpack' )
const MiniCssExtractPlugin = require( 'mini-css-extract-plugin' )

module.exports = {
  mode: 'development',
  entry: {
    frontend: [ './src/main.js' ],
    admin: [ './src/admin.js' ],
  },
  output: {
    path: path.resolve( __dirname, 'dist' ),
    filename: 'hopes.[name].bundle.js'
  },
  module: {
    rules: [
      {
        test: /\.(sa|sc|c)ss$/,
        use: [
          // Creates `style` nodes from JS strings
          MiniCssExtractPlugin.loader,
          // Translates CSS into CommonJS
          "css-loader",
          // Compiles Sass to CSS
          "sass-loader",
        ]
      },
      {
        test: /\.m?js$/,
        exclude: /(node_modules|bower_components)/,
        use: {
          loader: 'babel-loader',
          options: {
            presets: [ '@babel/preset-env' ]
          }
        }
      },
      {
        test: /\.(png|jpe?g|gif|svg)$/i,
        use: [
          {
            loader: 'file-loader',
            options: {
              publicPath: '../'
            }
          },
        ],
      },
    ]
  },
  plugins: [
    new MiniCssExtractPlugin( {
      filename: 'css/hopes.[name].css',
    } ),
    new webpack.ProvidePlugin( {
      Promise: 'es6-promise-promise', // works as expected
    } )
  ]
}