/**
 * Wordpress dependencies
 */
import { registerBlockType } from "@wordpress/blocks";

/**
 * Internal dependencies
 */
import metadata from "../block.json";
import edit from "./edit";

// Register the block
registerBlockType(metadata, {
  edit,
});
