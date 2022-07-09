/**
 * WordPress dependencies
 */
import { __ } from "@wordpress/i18n";
import {
  RichText,
  MediaUpload,
  URLInputButton,
  useBlockProps,
} from "@wordpress/block-editor";
import { Button } from "@wordpress/components";

const Edit = (props) => {
  const { attributes, setAttributes } = props;

  const onChangeTitle = (value) => {
    setAttributes({ title: value });
  };
  const onChangeSubtitle = (value) => {
    setAttributes({ subtitle: value });
  };
  const onChangeButton = (value) => {
    setAttributes({ button: value });
  };
  const onChangeURL = (value) => {
    setAttributes({ url: value });
  };
  const onSelectImage = (media) => {
    setAttributes({
      mediaURL: media.url,
      mediaID: media.id,
    });
  };

  const blockProps = useBlockProps();

  return (
    <div {...blockProps}>
      <section class="bg-blue-100 py-12 xl:pt-24 xl:pb-32 relative">
        <MediaUpload
          onSelect={onSelectImage}
          allowedTypes="image"
          value={attributes.mediaID}
          render={({ open }) => (
            <Button
              className="tpl-button tpl-button--white absolute top-0 left-0 z-10"
              onClick={open}>
              {!attributes.mediaID ? "Upload image" : "Edit image"}
            </Button>
          )}
        />
        <div class="tpl-image absolute top-0 left-0 w-full h-full z-0">
          <img src={attributes.mediaURL} alt="" />
        </div>
        <div class="container tpl-grid grid-cols-1 sm:grid-cols-12 z-10 relative">
          <div class="sm:col-span-7 p-8 lg:p-16 text-white rounded-md text-lg relative overflow-hidden">
            <div class="absolute top-0 left-0 bg-blue-800 w-full h-full opacity-80"></div>
            <div class="z-10 relative">
              <h1 class="mb-6">
                <RichText
                  tagName="h1"
                  placeholder="Write a title*"
                  value={attributes.title}
                  onChange={onChangeTitle}
                />
              </h1>
              <p class="mb-12">
                <RichText
                  tagName="p"
                  placeholder="Write a subtitle"
                  value={attributes.subtitle}
                  onChange={onChangeSubtitle}
                />
              </p>
              <a class="tpl-button tpl-button--white">
                <RichText
                  placeholder="Button text*"
                  value={attributes.button}
                  onChange={onChangeButton}
                />
              </a>
              <div class="text-grey-900">
                <URLInputButton url={attributes.url} onChange={onChangeURL} />
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  );
};
export default Edit;
