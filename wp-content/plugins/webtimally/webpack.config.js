/**
 * External Dependencies
 */
const path = require("path");

/**
 * WordPress Dependencies
 */
const defaultConfig = require("@wordpress/scripts/config/webpack.config.js");

const blocks = ["hero"];

const entries = () => {
  const temp = {};
  blocks.forEach((entry) => {
    temp[entry] = path.resolve(
      process.cwd(),
      "blocks/" + entry + "/src",
      "index.js"
    );
  });

  return temp;
};

module.exports = {
  ...defaultConfig,
  ...{
    entry: entries(),
    output: {
      filename: "[name].js",
      path: __dirname + "/build/",
    },
  },
};
