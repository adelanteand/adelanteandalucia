/**
 * Wrap table block in div.
 *
 * @param {object} element
 * @param {object} blockType
 * @param {object} attributes
 *
 * @return The element.
 */
const setExtraPropsToBlockType = (props, blockType, attributes) => {
  const notDefined = (typeof props.className === 'undefined' || !props.className) ? true : false

  if (blockType.name === 'core/heading') {
    return Object.assign(props, {
      className: notDefined ? `c-title-${attributes.level}` : `c-title-${attributes.level} ${props.className}`,
    });
  }

  return props;
};

wp.hooks.addFilter(
  'blocks.getSaveContent.extraProps',
  'wb/block-filters',
  setExtraPropsToBlockType
);

wp.domReady(() => {
  wp.blocks.unregisterBlockStyle('core/table', 'stripes');
  wp.blocks.unregisterBlockStyle('core/table', 'regular');
  wp.blocks.unregisterBlockStyle('core/image', 'rounded');
  wp.blocks.unregisterBlockStyle('core/button', 'fill');
  wp.blocks.unregisterBlockStyle('core/button', 'outline');
  wp.blocks.unregisterBlockStyle('core/pullquote', 'solid-color');
});

