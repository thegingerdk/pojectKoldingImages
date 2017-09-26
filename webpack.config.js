let webpack = require('webpack');
let path = require('path');

let BUILD_DIR = path.resolve(__dirname, 'assets/js');
let APP_DIR = path.resolve(__dirname, 'Resources/js');

let config = {
    entry: APP_DIR + '/app.js',
    output: {
        path: BUILD_DIR,
        filename: 'app.js'
    },
    devtool: "source-map", // any "source-map"-like devtool is possible
    module: {
        rules: [{
            test: /\.scss$/,
            use: [{
                loader: "style-loader"
            }, {
                loader: "css-loader", options: {
                    sourceMap: true
                }
            }, {
                loader: "sass-loader", options: {
                    sourceMap: true
                }
            }]
        }]
    }
};

module.exports = config;