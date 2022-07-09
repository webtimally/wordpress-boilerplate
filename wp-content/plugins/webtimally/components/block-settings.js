import { __ } from "@wordpress/i18n";
import { InspectorControls } from "@wordpress/block-editor";
import { Fragment } from "@wordpress/element";
import { PanelBody, SelectControl } from "@wordpress/components";

export const blockSettings = (attributes, setAttributes) => {
  const onChangeBackground = (value) => {
    setAttributes({ background: value });
  };
  const onChangePadding = (value) => {
    setAttributes({ padding: value });
  };

  return (
    <Fragment>
      <InspectorControls>
        <PanelBody title="Block settings" initialOpen={false}>
          {attributes.background && (
            <SelectControl
              label="Background colour"
              value={attributes.background}
              options={[
                { label: "White", value: "bg-white" },
                { label: "Light Grey", value: "bg-grey-100" },
              ]}
              onChange={onChangeBackground}
            />
          )}
          {attributes.padding && (
            <SelectControl
              label="Top and bottom padding"
              value={attributes.padding}
              options={[
                { label: "Regular", value: "narrow" },
                { label: "Medium", value: "thin" },
                { label: "Small", value: "thinner" },
              ]}
              onChange={onChangePadding}
            />
          )}
        </PanelBody>
      </InspectorControls>
    </Fragment>
  );
};
