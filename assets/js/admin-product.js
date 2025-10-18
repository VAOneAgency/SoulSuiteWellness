jQuery(document).ready(function($) {
    'use strict';

    // Media uploader for product gallery
    var mediaUploader;
    var $galleryImages = $('.soul-gallery-images');
    var $galleryInput = $('#soul_product_gallery');

    // Open media uploader for gallery
    $('#add-gallery-images').on('click', function(e) {
        e.preventDefault();

        // If the media frame already exists, reopen it
        if (mediaUploader) {
            mediaUploader.open();
            return;
        }

        // Create the media frame
        mediaUploader = wp.media({
            title: soulProductAdmin.mediaTitle,
            button: {
                text: soulProductAdmin.mediaButton
            },
            multiple: true
        });

        // When an image is selected, run a callback
        mediaUploader.on('select', function() {
            var attachmentIds = [];
            var attachments = mediaUploader.state().get('selection').toJSON();
            
            // Process each selected attachment
            attachments.forEach(function(attachment) {
                attachmentIds.push(attachment.id);
                
                // Add image to gallery
                var imageItem = $(
                    '<li class="image" data-attachment_id="' + attachment.id + '">' +
                        '<img src="' + attachment.sizes.thumbnail ? attachment.sizes.thumbnail.url : attachment.url + '" />' +
                        '<a href="#" class="delete" title="' + soulProductAdmin.removeImage + '">×</a>' +
                    '</li>'
                );
                
                $galleryImages.append(imageItem);
            });
            
            // Update hidden input with attachment IDs
            updateGalleryInput();
        });

        // Open the uploader dialog
        mediaUploader.open();
    });

    // Remove image from gallery
    $(document).on('click', '.soul-gallery-images .delete', function(e) {
        e.preventDefault();
        $(this).closest('li').remove();
        updateGalleryInput();
    });

    // Update the hidden input with the current gallery image IDs
    function updateGalleryInput() {
        var attachmentIds = [];
        
        $('.soul-gallery-images li').each(function() {
            attachmentIds.push($(this).data('attachment_id'));
        });
        
        $galleryInput.val(attachmentIds.join(','));
    }

    // Handle duration selection
    $('#soul_product_duration').on('change', function() {
        var $customDuration = $('#soul_product_duration_custom');
        
        if ($(this).val() === 'custom') {
            $customDuration.show().focus();
        } else {
            $customDuration.hide();
        }
    });

    // Validate price fields
    $('input[type="number"]').on('blur', function() {
        var value = parseFloat($(this).val());
        
        if (isNaN(value) || value < 0) {
            $(this).val('');
        } else {
            $(this).val(value.toFixed(2));
        }
    });

    // Toggle sale price field based on regular price
    $('#soul_product_price').on('change', function() {
        var $salePrice = $('#soul_product_sale_price');
        var regularPrice = parseFloat($(this).val());
        var salePrice = parseFloat($salePrice.val());
        
        if (!isNaN(regularPrice) && !isNaN(salePrice) && salePrice >= regularPrice) {
            $salePrice.val('').trigger('change');
        }
    });

    // Handle stock quantity field
    $('#soul_product_stock_quantity').on('change', function() {
        var value = parseInt($(this).val());
        
        if (isNaN(value) || value < 0) {
            $(this).val('0');
        } else {
            $(this).val(Math.floor(value));
        }
        
        // Update stock status if needed
        if (value > 0) {
            $('#soul_product_stock_status').val('instock');
        } else if (value <= 0 && $('#soul_product_stock_status').val() === 'instock') {
            $('#soul_product_stock_status').val('outofstock');
        }
    });

    // Initialize sortable gallery
    if ($galleryImages.length) {
        $galleryImages.sortable({
            items: 'li',
            cursor: 'move',
            scrollSensitivity: 40,
            forcePlaceholderSize: true,
            forceHelperSize: false,
            helper: 'clone',
            opacity: 0.65,
            stop: function() {
                updateGalleryInput();
            }
        });
    }
});
