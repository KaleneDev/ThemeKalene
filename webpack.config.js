const webpack = require("webpack");
const path = require("path");
const MiniCssExtractPlugin = require("mini-css-extract-plugin");
const BrowserSyncPlugin = require("browser-sync-webpack-plugin");

const config = {
    mode: "development",
    entry: {
        main: ["./src/js/main.js", "./src/scss/main.scss"],
    },
    output: {
        path: path.resolve(__dirname, "assets"),
        filename: "[name].min.js",
        clean: true,
    },
    devtool: "source-map",
    module: {
        rules: [
            {
                test: /\.scss$/,
                use: [MiniCssExtractPlugin.loader, "css-loader", "sass-loader"],
            },
            {
                test: /\.js$/,
                use: "babel-loader",
                exclude: /node_modules/,
            },
            {
                test: /\.png$/,
                use: [
                    {
                        loader: "url-loader",
                        options: {
                            mimetype: "image/png",
                        },
                    },
                ],
            },
            {
                test: /\.(svg|jpg|gif|png)$/,
                type: "asset/resource",
                generator: {
                    filename: "images/[name][ext]",
                },
            },
        ],
    },
    plugins: [
        new MiniCssExtractPlugin(),
        new BrowserSyncPlugin({
            proxy: "http://localhost:8888/Immobilier/", // Remplacez "path-to-your-wordpress-site" par le chemin de votre site WordPress local
            files: ["**/*.php", "**/*.css", "**/*.scss"], // Surveillez les fichiers PHP et CSS pour le rechargement automatique
            reloadDebounce: 0, // Délai de rechargement automatique après les modifications (en millisecondes)
        }),
    ],
};

module.exports = config;
