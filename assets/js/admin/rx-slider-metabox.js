jQuery(document).ready(function($){
    var slider_gallery = $('#slider_gallery');
    var add_image = $('.slider_image_add');
    var image_template = `<div class="slider_image">
                            <a class="slider_image_remove" href="#">Remove Image</a>
                            <div class="slider_image_preview"></div>
                            <input class="slider_image_url" type="hidden" name="slider_gallery[%ID%][url]" value="" />
                            <label> 
                                <input class="slider_image_subtitle" type="text" name="slider_gallery[%ID%][subtitle]" value="" placeholder="Subtitle"/>
                            </label>
                            <label>
                                <input class="slider_image_title" type="text" name="slider_gallery[%ID%][title]" value="" placeholder="Title"/>
                            </label>
                          </div>'`;
    var counter = $('.slider_image').length;

    add_image.on('click', function(e){
        e.preventDefault();
        var image = wp.media({
            title: 'Select Image',
            library: {
                type: 'image'
            },
            multiple: false
        }).on('select', function(){
            var attachment = image.state().get('selection').first().toJSON();
            var new_image = $(image_template.replace(/%ID%/g, counter));
            new_image.find('.slider_image_preview').css('background-image', 'url(' + attachment.url + ')');
            new_image.find('.slider_image_url').val(attachment.url);
            new_image.find('.slider_image_title').val(attachment.title);
            new_image.find('.slider_image_subtitle').val(attachment.subtitle);
            slider_gallery.append(new_image);
            counter++;
            resetSlideIndexes();
            slider_gallery.sortable('refresh');
            });
            image.open();
        });
        slider_gallery.sortable({
            update: function(event, ui) {
                var images = [];
                slider_gallery.find('.slider_image').each(function(index) {
                    var id = $(this).attr('data-id');
                    var url = $(this).find('.slider_image_url').val();
                    var title = $(this).find('.slider_image_title').val();
                    var subtitle = $(this).find('.slider_image_subtitle').val();
                    images.push({
                        id: id,
                        url: url,
                        title: title,
                        subtitle: subtitle
                    });
                });
                $('#slider_gallery_input').val(JSON.stringify(images));
                resetSlideIndexes();
            }
        });
        
        slider_gallery.on('click', '.slider_image_remove', function(e){
            e.preventDefault();
            $(this).parent().remove();
            counter--;
            resetSlideIndexes();
            slider_gallery.sortable('refresh');
        });
        
        function resetSlideIndexes() {
            var slides = $('.slider_image');
            for (var i = 0; i < slides.length; i++) {
                var slide = $(slides[i]);
                var id = i;
                slide.find('.slider_image_url').attr('name', 'slider_gallery[' + id + '][url]');
                slide.find('.slider_image_title').attr('name', 'slider_gallery[' + id + '][title]');
                slide.find('.slider_image_subtitle').attr('name', 'slider_gallery[' + id + '][subtitle]');
                console.log(i)
            }
        }
        
});