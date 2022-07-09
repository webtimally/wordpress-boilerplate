import { __ } from "@wordpress/i18n";
import { registerBlockType } from "@wordpress/blocks";
import {
  RichText,
  MediaUpload,
  URLInputButton,
  InnerBlocks,
} from "@wordpress/block-editor";
import { Button } from "@wordpress/components";

registerBlockType("webtimally/block-xx-name", {
  title: "NAME",
  icon: "cover-image",
  category: "theme",
  attributes: {
    mediaID: {
      type: "number",
    },
    mediaURL: {
      type: "string",
    },
    title: {
      type: "string",
    },
    url: {
      type: "string",
    },
    button: {
      type: "string",
    },
  },
  example: {},
  edit: (props) => {
    const { attributes, setAttributes } = props;

    const ALLOWED_BLOCKS = ["webtimally/column-block-services"];

    const onChangeTitle = (value) => {
      setAttributes({ title: value });
    };
    const onChangeURL = (value) => {
      setAttributes({ url: value });
    };
    const onChangeButton = (value) => {
      setAttributes({ button: value });
    };
    const onSelectImage = (media) => {
      setAttributes({
        mediaURL: media.url,
        mediaID: media.id,
      });
    };

    return (
      <>
        {/* Sample MediaUpload Block */}
        <MediaUpload
          onSelect={onSelectImage}
          allowedTypes="image"
          value={attributes.mediaID}
          render={({ open }) => (
            <Button
              className="tpl-button tpl-button--white absolute top-0 left-0 z-10"
              onClick={open}
            >
              {!attributes.mediaID ? "Upload image" : "Edit image"}
            </Button>
          )}
        />

        {/* Sample RichText Block */}
        <RichText
          placeholder="Write a title"
          value={attributes.title}
          onChange={onChangeTitle}
        />

        {/* Sample Button + URLInputButton Block */}
        <a class="tpl-button tpl-button--white">
          <RichText
            placeholder="Button text"
            value={attributes.button}
            onChange={onChangeButton}
          />
        </a>
        <div class="text-grey-900">
          <URLInputButton url={attributes.url} onChange={onChangeURL} />
        </div>

        {/* Sample InnerBlocks */}
        <InnerBlocks
          placeholder="Insert something"
          orientation="horizontal"
          allowedBlocks={ALLOWED_BLOCKS}
        />
      </>
    );
  },
});

export default Edit;
