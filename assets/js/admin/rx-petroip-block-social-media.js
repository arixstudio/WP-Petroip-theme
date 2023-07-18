( function( blocks, components, element ) {
    var el = element.createElement;
    var registerBlockType = blocks.registerBlockType;

    var iconInstagram = el( 'span', { className: 'dashicons dashicons-instagram' } );
    var iconLinkedin = el( 'span', { className: 'dashicons dashicons-linkedin' } );
    var iconTwitter = el( 'span', { className: 'dashicons dashicons-twitter' } );
  
    registerBlockType( 'rx-petroip/social-media', {
      title: 'RX Social media',
      icon: 'instagram',
      category: 'common',
      attributes: {
        twitter: {
          type: 'string',
          source: 'text',
          default: 'https://twitter.com/',
          selector: '.twitter'
        },
        linkedin: {
          type: 'string',
          source: 'text',
          default: 'https://linkedin.com/',
          selector: '.linkedin'
        },
        instagram: {
          type: 'string',
          source: 'text',
          default: 'https://instagram.com/',
          selector: '.instagram'
        },
        alignment: {
          type: 'string',
          default: 'none'
        }
      },
      edit: function( props ) {
        var attributes = props.attributes;
        var setAttributes = props.setAttributes;
        const { name } = props;
        const { title, icon } = wp.blocks.getBlockType(name);
      
        function onChangeTwitter( value ) {
          setAttributes( { twitter: value } );
        }

        function onChangeInstagram( value ) {
          setAttributes( { instagram: value } );
        }
        
        function onChangeLinkedin( value ) {
          setAttributes( { linkedin: value } );
        }
  
        return [
          el('div', { className: props.className + ' components-placeholder' },
            el(
              'span',
              { className: 'components-placeholder__label' },
              el('i', { className: 'dashicon dashicons dashicons-' + icon.src }),
              title
            ),
            el('div', { className: 'rx-block-field' },
              el(components.TextControl, {
                label: 'Twitter',
                value: attributes.twitter,
                onChange: onChangeTwitter,
              }),
            ),
            el('div', { className: 'rx-block-field' },
              el(components.TextControl, {
                label: 'Linkedin',
                value: attributes.linkedin,
                onChange: onChangeLinkedin,
              }),
            ),
            el('div', { className: 'rx-block-field' },
              el(components.TextControl, {
                label: 'Instagram',
                value: attributes.instagram,
                onChange: onChangeInstagram,
              }),
            ),
          ),
        ];
      },
      save: function( props ) {
        return el(
          'div',
          { className: props.className },
          el(
            'div',
            { className: 'twitter' },
            el(
              'a',
              { href: props.attributes.twitter },
              el(
                'span',
                { className: 'social-icon' },
                iconTwitter
              ),
              el('span',{className:'d-none'},props.attributes.twitter)
            ),
          ),
          el(
            'div',
            { className: 'linkedin' },
            el(
              'a',
              { href: props.attributes.linkedin },
              el(
                'span',
                { className: 'social-icon' },
                iconLinkedin
              ),
              el('span',{className:'d-none'},props.attributes.linkedin)
            ),
          ),
          el(
            'div',
            { className: 'instagram' },
            el(
              'a',
              { href: props.attributes.instagram },
              el(
                'span',
                { className: 'social-icon' },
                iconInstagram
              ),
              el('span',{className:'d-none'},props.attributes.instagram)
            )
          ),
        );
      }
    } );
  } )(
    window.wp.blocks,
    window.wp.components,
    window.wp.element
  );
  