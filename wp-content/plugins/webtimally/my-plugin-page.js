const allowedExtraBlocks = [
  "core/paragraph",
  "core/heading",
  "core/list",
  "core/image",
];

wp.domReady(function () {
  // wp.blocks.unregisterBlockType("core/verse");
  wp.blocks.getBlockTypes().forEach(function (blockType) {
    if (
      !blockType.name.startsWith("webtimally") &&
      allowedExtraBlocks.indexOf(blockType.name) === -1
    ) {
      wp.blocks.unregisterBlockType(blockType.name);
    }
  });
});
