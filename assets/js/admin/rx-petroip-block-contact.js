( function( blocks, components, element ) {
    var rx_petroip_template_directory_uri = 'http://localhost/petroip/wp-content/themes/rx-petroip'

    var el = element.createElement;
    var registerBlockType = blocks.registerBlockType;

    var iconEmail = el( 'img', { src: rx_petroip_template_directory_uri + '/assets/img/icon-email.svg', alt: 'Email' } );
    var iconPhone = el( 'img', { src: rx_petroip_template_directory_uri + '/assets/img/icon-phone.svg', alt: 'Phone' } );
    var iconAddress = el( 'img', { src: rx_petroip_template_directory_uri + '/assets/img/icon-address.svg', alt: 'Address' } );
  
    registerBlockType( 'rx-petroip/contact-detail', {
      title: 'RX Contact Detail',
      icon: 'phone',
      category: 'common',
      attributes: {
        email: {
          type: 'string',
          source: 'text',
          default: '#',
          selector: '.email'
        },
        phone: {
          type: 'string',
          source: 'text',
          default: '#',
          selector: '.phone'
        },
        address: {
          type: 'string',
          source: 'text',
          default: '#',
          selector: '.address'
        },
        language: {
          type: 'string',
          default: 'en'
        },
        alignment: {
          type: 'string',
          default: 'none'
        }
      },
      edit: function( props ) {
        // console.log(props)
        var attributes = props.attributes;
        var setAttributes = props.setAttributes;
        const { name } = props;
        const { title, icon } = wp.blocks.getBlockType(name);
      
        function onChangeEmail( value ) {
          setAttributes( { email: value } );
        }
        
        function onChangePhone( value ) {
          setAttributes( { phone: value } );
        }

        function onChangeAddress( value ) {
          setAttributes( { address: value } );
        }

        function onChangeLanguage(value) {
          setAttributes({ language: value });
        }

        var languageOptions = [
          { value: 'en', label: 'English' },
          { value: 'fa', label: 'Persian' },
        ];
  
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
                label: 'Email',
                value: attributes.email,
                onChange: onChangeEmail,
              }),
            ),
            el('div', { className: 'rx-block-field' },
              el(components.TextControl, {
                label: 'Phone',
                value: attributes.phone,
                onChange: onChangePhone,
              }),
            ),
            el('div', { className: 'rx-block-field' },
              el(components.TextControl, {
                label: 'Address',
                value: attributes.address,
                onChange: onChangeAddress,
              }),
            ),
            el('div', { className: 'rx-block-field' },
              el(components.SelectControl, {
                label: 'Language',
                value: attributes.language,
                options: languageOptions,
                onChange: onChangeLanguage,
              }),
            ),
          ),
        ];
      },
      save: function( props ) {
        console.log(props)
        return el(
          'div',
          { className: props.className + ' show-in-' + props.attributes.language },
          el(
            'div',
            { className: 'email' },
            el(
              'a',
              { href: 'mailto:' + props.attributes.email },
              el(
                'span',
                { className: 'contact-icon' },
                iconEmail
              ),
              props.attributes.email
            )
          ),
          el(
            'div',
            { className: 'phone' },
            el(
              'a',
              { href: 'tel:' + props.attributes.phone },
              el(
                'span',
                { className: 'contact-icon' },
                iconPhone
              ),
              props.attributes.phone
            ),
          ),
          el(
            'div',
            { className: 'address' },
            el(
              'span',
              { className: 'contact-icon' },
              iconAddress
            ),
            props.attributes.address
          ),
        );
      }
    } );
  } )(
    window.wp.blocks,
    window.wp.components,
    window.wp.element
  );
  