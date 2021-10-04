$(document).ready(function() {
  $('#posts_table').DataTable();
 

  // $("#error_alert").alert('close');
  // $("#success_alert").alert('close');

  $("#form_categorie").submit(function (event) {
      var formData = {
        categorie: $("#categorie_name").val(),
        parent_categorie: $("#categorie").val(),
      };

      $.ajax({
      type: "POST",
      url: "save-categorie",    
      data: formData,
      }).done(function (data) {
          if(data){

              // $('#success_alert').alert();
              // $("#error_alert").alert('close');
          }else{
              // $('#error_alert').alert();
              // $("#success_alert").alert('close');
          }
      });

      event.preventDefault();
  });
});

$('input[type="checkbox"]').change(function(e) {

  var checked = $(this).prop("checked"),
      container = $(this).parent(),
      siblings = container.siblings();

  container.find('input[type="checkbox"]').prop({
    indeterminate: false,
    checked: checked
  });

  function checkSiblings(el) {

    var parent = el.parent().parent(),
        all = true;

    el.siblings().each(function() {
      let returnValue = all = ($(this).children('input[type="checkbox"]').prop("checked") === checked);
      return returnValue;
    });
    
    if (all && checked) {

      parent.children('input[type="checkbox"]').prop({
        indeterminate: false,
        checked: checked
      });

      checkSiblings(parent);

    } else if (all && !checked) {

      parent.children('input[type="checkbox"]').prop("checked", checked);
      parent.children('input[type="checkbox"]').prop("indeterminate", (parent.find('input[type="checkbox"]:checked').length > 0));
      checkSiblings(parent);

    } else {

      el.parents("li").children('input[type="checkbox"]').prop({
        indeterminate: true,
        checked: false
      });

    }

  }

  checkSiblings(container);
});

//Text editor

    tinymce.init({
        mode: "textareas",
            plugins: 'lists media table image',
            image_title: true,
            rows:40,
            // images_upload_url : document.location.hostname + '/image-upload',
                /* enable automatic uploads of images represented by blob or data URIs*/
                automatic_uploads: true,
                image_caption: true,
                images_upload_base_path : 'https://historyinurdu.com/image-upload',
                /*
                    URL of our upload handler (for more details check: https://www.tiny.cloud/docs/configure/file-image-upload/#images_upload_url)
                    images_upload_url: 'postAcceptor.php',
                    here we add custom filepicker only to Image dialog
                */
                file_picker_types: 'image',
                image_dimensions: false,
                 image_class_list: [
                    {title: 'Responsive', value: 'img-responsive'}
                ],
                /* and here's our custom image picker*/
                images_upload_handler : function(blobInfo, success, failure) {
                  var xhr, formData;
            
                  xhr = new XMLHttpRequest();
                  xhr.withCredentials = false;
                  xhr.open('POST', 'https://historyinurdu.com/image-upload');
            
                  xhr.onload = function() {
                    var json;
            
                    if (xhr.status != 200) {
                      failure('HTTP Error: ' + xhr.status);
                      return;
                    }
            
                    json = JSON.parse(xhr.responseText);
            
                    if (!json || typeof json.file_path != 'string') {
                      failure('Invalid JSON: ' + xhr.responseText);
                      return;
                    }
            
                    success( 'https://historyinurdu.com/'+ json.file_path);
                  };
            
                  formData = new FormData();
                  formData.append('file', blobInfo.blob(), blobInfo.filename());
            
                  xhr.send(formData);
                },
                
            // toolbar: 'ltr rtl a11ycheck checklist code formatpainter pageembed permanentpen table',
            toolbar: 'fullscreen print forecolor backcolor removeformat | undo redo | bold italic underline strikethrough fontselect fontsizeselect formatselect | alignleft aligncenter alignright alignjustify | outdent indent |  numlist bullist pagebreak | charmap emoticons | fullscreen  preview save print | insertfile image media template link anchor | ltr rtl',
            // toolbar_location: 'bottom',
            toolbar_mode: 'floating',
            tinycomments_mode: 'embedded',
            height: 600,
            tinycomments_author: 'Write Urdu',
            directionality: "rtl",
            fontsize_formats:
                "8px 9px 10px 11px 12px 14px 18px 22px 24px 30px 36px 48px 60px 72px 96px",
            content_style: "@import url('https://fonts.googleapis.com/earlyaccess/notonastaliqurdu.css?family=Noto Nastaliq Urdu&display=Noto Nastaliq Urdu);body { font-family: 'Noto Nastaliq Urdu'; };.mce-content-body {font-size:15px;font-family:Arial,sans-serif;}",
            font_formats: "Noto Nastaliq Urdu;Noto Naskh Arabic;Qadreeregular;Amiri;Harmattan;Katibeh;Lateef;Scheherazade;Tajawal;Andale Mono=andale mono,times; Arial=arial,helvetica,sans-serif; Arial Black=arial black,avant garde; Book Antiqua=book antiqua,palatino; Comic Sans MS=comic sans ms,sans-serif; Courier New=courier new,courier; Georgia=georgia,palatino; Helvetica=helvetica; Impact=impact,chicago; Oswald=oswald; Symbol=symbol; Tahoma=tahoma,arial,helvetica,sans-serif; Terminal=terminal,monaco; Times New Roman=times new roman,times; Trebuchet MS=trebuchet ms,geneva; Verdana=verdana,geneva; Webdings=webdings; Wingdings=wingdings,zapf dingbats",
            "content_css": 'https://fonts.googleapis.com/earlyaccess/notonastaliqurdu.css,https://fonts.googleapis.com/earlyaccess/notonaskharabic.css,/fonts/Qadreeregular.css,https://fonts.googleapis.com/css2?family=Amiri&family=Harmattan:wght@400;700&family=Katibeh&family=Lateef&family=Markazi+Text&family=Scheherazade:wght@400;700&family=Tajawal:wght@300;400&display=swap" rel="stylesheet',
            setup: function (ed) {
                ed.on('init', function () {

                    $(this.getDoc()).find('head').append("<style>p{margin:0; font-size: 16px !important;font-family: 'Noto Nastaliq Urdu';}</style>");
                    $('#spinner').hide();
                    //  $('[data-toggle="tooltip"]').tooltip();
                });
            },
            init_instance_callback: "insert_contents",
   });
 



//Live img show on select
function readURL(input) {
    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
            $('#blah')
                .attr('src', e.target.result)
                .width(300)
                .height(200);
        };

        reader.readAsDataURL(input.files[0]);
    }
}

///
// bootstrap-tagsinput.js file - add in local

(function ($) {
    "use strict";
  
    var defaultOptions = {
      tagClass: function(item) {
        return 'label label-info';
      },
      itemValue: function(item) {
        return item ? item.toString() : item;
      },
      itemText: function(item) {
        return this.itemValue(item);
      },
      itemTitle: function(item) {
        return null;
      },
      freeInput: true,
      addOnBlur: true,
      maxTags: undefined,
      maxChars: undefined,
      confirmKeys: [13, 44],
      delimiter: ',',
      delimiterRegex: null,
      cancelConfirmKeysOnEmpty: true,
      onTagExists: function(item, $tag) {
        $tag.hide().fadeIn();
      },
      trimValue: false,
      allowDuplicates: false
    };
  
    /**
     * Constructor function
     */
    function TagsInput(element, options) {
      this.itemsArray = [];
  
      this.$element = $(element);
      this.$element.hide();
  
      this.isSelect = (element.tagName === 'SELECT');
      this.multiple = (this.isSelect && element.hasAttribute('multiple'));
      this.objectItems = options && options.itemValue;
      this.placeholderText = element.hasAttribute('placeholder') ? this.$element.attr('placeholder') : '';
      this.inputSize = Math.max(1, this.placeholderText.length);
  
      this.$container = $('<div class="bootstrap-tagsinput"></div>');
      this.$input = $('<input type="text" placeholder="' + this.placeholderText + '"/>').appendTo(this.$container);
  
      this.$element.before(this.$container);
  
      this.build(options);
    }
  
    TagsInput.prototype = {
      constructor: TagsInput,
  
      /**
       * Adds the given item as a new tag. Pass true to dontPushVal to prevent
       * updating the elements val()
       */
      add: function(item, dontPushVal, options) {
        var self = this;
  
        if (self.options.maxTags && self.itemsArray.length >= self.options.maxTags)
          return;
  
        // Ignore falsey values, except false
        if (item !== false && !item)
          return;
  
        // Trim value
        if (typeof item === "string" && self.options.trimValue) {
          item = $.trim(item);
        }
  
        // Throw an error when trying to add an object while the itemValue option was not set
        if (typeof item === "object" && !self.objectItems)
          throw("Can't add objects when itemValue option is not set");
  
        // Ignore strings only containg whitespace
        if (item.toString().match(/^\s*$/))
          return;
  
        // If SELECT but not multiple, remove current tag
        if (self.isSelect && !self.multiple && self.itemsArray.length > 0)
          self.remove(self.itemsArray[0]);
  
        if (typeof item === "string" && this.$element[0].tagName === 'INPUT') {
          var delimiter = (self.options.delimiterRegex) ? self.options.delimiterRegex : self.options.delimiter;
          var items = item.split(delimiter);
          if (items.length > 1) {
            for (var i = 0; i < items.length; i++) {
              this.add(items[i], true);
            }
  
            if (!dontPushVal)
              self.pushVal();
            return;
          }
        }
  
        var itemValue = self.options.itemValue(item),
            itemText = self.options.itemText(item),
            tagClass = self.options.tagClass(item),
            itemTitle = self.options.itemTitle(item);
  
        // Ignore items allready added
        var existing = $.grep(self.itemsArray, function(item) { return self.options.itemValue(item) === itemValue; } )[0];
        if (existing && !self.options.allowDuplicates) {
          // Invoke onTagExists
          if (self.options.onTagExists) {
            var $existingTag = $(".tag", self.$container).filter(function() { return $(this).data("item") === existing; });
            self.options.onTagExists(item, $existingTag);
          }
          return;
        }
  
        // if length greater than limit
        if (self.items().toString().length + item.length + 1 > self.options.maxInputLength)
          return;
  
        // raise beforeItemAdd arg
        var beforeItemAddEvent = $.Event('beforeItemAdd', { item: item, cancel: false, options: options});
        self.$element.trigger(beforeItemAddEvent);
        if (beforeItemAddEvent.cancel)
          return;
  
        // register item in internal array and map
        self.itemsArray.push(item);
  
        // add a tag element
  
        var $tag = $('<span class="tag ' + htmlEncode(tagClass) + (itemTitle !== null ? ('" title="' + itemTitle) : '') + '">' + htmlEncode(itemText) + '<span data-role="remove"></span></span>');
        $tag.data('item', item);
        self.findInputWrapper().before($tag);
        $tag.after(' ');
  
        // add <option /> if item represents a value not present in one of the <select />'s options
        if (self.isSelect && !$('option[value="' + encodeURIComponent(itemValue) + '"]',self.$element)[0]) {
          var $option = $('<option selected>' + htmlEncode(itemText) + '</option>');
          $option.data('item', item);
          $option.attr('value', itemValue);
          self.$element.append($option);
        }
  
        if (!dontPushVal)
          self.pushVal();
  
        // Add class when reached maxTags
        if (self.options.maxTags === self.itemsArray.length || self.items().toString().length === self.options.maxInputLength)
          self.$container.addClass('bootstrap-tagsinput-max');
  
        self.$element.trigger($.Event('itemAdded', { item: item, options: options }));
      },
  
      /**
       * Removes the given item. Pass true to dontPushVal to prevent updating the
       * elements val()
       */
      remove: function(item, dontPushVal, options) {
        var self = this;
  
        if (self.objectItems) {
          if (typeof item === "object")
            item = $.grep(self.itemsArray, function(other) { return self.options.itemValue(other) ==  self.options.itemValue(item); } );
          else
            item = $.grep(self.itemsArray, function(other) { return self.options.itemValue(other) ==  item; } );
  
          item = item[item.length-1];
        }
  
        if (item) {
          var beforeItemRemoveEvent = $.Event('beforeItemRemove', { item: item, cancel: false, options: options });
          self.$element.trigger(beforeItemRemoveEvent);
          if (beforeItemRemoveEvent.cancel)
            return;
  
          $('.tag', self.$container).filter(function() { return $(this).data('item') === item; }).remove();
          $('option', self.$element).filter(function() { return $(this).data('item') === item; }).remove();
          if($.inArray(item, self.itemsArray) !== -1)
            self.itemsArray.splice($.inArray(item, self.itemsArray), 1);
        }
  
        if (!dontPushVal)
          self.pushVal();
  
        // Remove class when reached maxTags
        if (self.options.maxTags > self.itemsArray.length)
          self.$container.removeClass('bootstrap-tagsinput-max');
  
        self.$element.trigger($.Event('itemRemoved',  { item: item, options: options }));
      },
  
      /**
       * Removes all items
       */
      removeAll: function() {
        var self = this;
  
        $('.tag', self.$container).remove();
        $('option', self.$element).remove();
  
        while(self.itemsArray.length > 0)
          self.itemsArray.pop();
  
        self.pushVal();
      },
  
      /**
       * Refreshes the tags so they match the text/value of their corresponding
       * item.
       */
      refresh: function() {
        var self = this;
        $('.tag', self.$container).each(function() {
          var $tag = $(this),
              item = $tag.data('item'),
              itemValue = self.options.itemValue(item),
              itemText = self.options.itemText(item),
              tagClass = self.options.tagClass(item);
  
            // Update tag's class and inner text
            $tag.attr('class', null);
            $tag.addClass('tag ' + htmlEncode(tagClass));
            $tag.contents().filter(function() {
              return this.nodeType == 3;
            })[0].nodeValue = htmlEncode(itemText);
  
            if (self.isSelect) {
              var option = $('option', self.$element).filter(function() { return $(this).data('item') === item; });
              option.attr('value', itemValue);
            }
        });
      },
  
      /**
       * Returns the items added as tags
       */
      items: function() {
        return this.itemsArray;
      },
  
      /**
       * Assembly value by retrieving the value of each item, and set it on the
       * element.
       */
      pushVal: function() {
        var self = this,
            val = $.map(self.items(), function(item) {
              return self.options.itemValue(item).toString();
            });
  
        self.$element.val(val, true).trigger('change');
      },
  
      /**
       * Initializes the tags input behaviour on the element
       */
      build: function(options) {
        var self = this;
  
        self.options = $.extend({}, defaultOptions, options);
        // When itemValue is set, freeInput should always be false
        if (self.objectItems)
          self.options.freeInput = false;
  
        makeOptionItemFunction(self.options, 'itemValue');
        makeOptionItemFunction(self.options, 'itemText');
        makeOptionFunction(self.options, 'tagClass');
  
        // Typeahead Bootstrap version 2.3.2
        if (self.options.typeahead) {
          var typeahead = self.options.typeahead || {};
  
          makeOptionFunction(typeahead, 'source');
  
          self.$input.typeahead($.extend({}, typeahead, {
            source: function (query, process) {
              function processItems(items) {
                var texts = [];
  
                for (var i = 0; i < items.length; i++) {
                  var text = self.options.itemText(items[i]);
                  map[text] = items[i];
                  texts.push(text);
                }
                process(texts);
              }
  
              this.map = {};
              var map = this.map,
                  data = typeahead.source(query);
  
              if ($.isFunction(data.success)) {
                // support for Angular callbacks
                data.success(processItems);
              } else if ($.isFunction(data.then)) {
                // support for Angular promises
                data.then(processItems);
              } else {
                // support for functions and jquery promises
                $.when(data)
                 .then(processItems);
              }
            },
            updater: function (text) {
              self.add(this.map[text]);
              return this.map[text];
            },
            matcher: function (text) {
              return (text.toLowerCase().indexOf(this.query.trim().toLowerCase()) !== -1);
            },
            sorter: function (texts) {
              return texts.sort();
            },
            highlighter: function (text) {
              var regex = new RegExp( '(' + this.query + ')', 'gi' );
              return text.replace( regex, "<strong>$1</strong>" );
            }
          }));
        }
  
        // typeahead.js
        if (self.options.typeaheadjs) {
            var typeaheadConfig = null;
            var typeaheadDatasets = {};
  
            // Determine if main configurations were passed or simply a dataset
            var typeaheadjs = self.options.typeaheadjs;
            if ($.isArray(typeaheadjs)) {
              typeaheadConfig = typeaheadjs[0];
              typeaheadDatasets = typeaheadjs[1];
            } else {
              typeaheadDatasets = typeaheadjs;
            }
  
            self.$input.typeahead(typeaheadConfig, typeaheadDatasets).on('typeahead:selected', $.proxy(function (obj, datum) {
              if (typeaheadDatasets.valueKey)
                self.add(datum[typeaheadDatasets.valueKey]);
              else
                self.add(datum);
              self.$input.typeahead('val', '');
            }, self));
        }
  
        self.$container.on('click', $.proxy(function(event) {
          if (! self.$element.attr('disabled')) {
            self.$input.removeAttr('disabled');
          }
          self.$input.focus();
        }, self));
  
          if (self.options.addOnBlur && self.options.freeInput) {
            self.$input.on('focusout', $.proxy(function(event) {
                // HACK: only process on focusout when no typeahead opened, to
                //       avoid adding the typeahead text as tag
                if ($('.typeahead, .twitter-typeahead', self.$container).length === 0) {
                  self.add(self.$input.val());
                  self.$input.val('');
                }
            }, self));
          }
  
  
        self.$container.on('keydown', 'input', $.proxy(function(event) {
          var $input = $(event.target),
              $inputWrapper = self.findInputWrapper();
  
          if (self.$element.attr('disabled')) {
            self.$input.attr('disabled', 'disabled');
            return;
          }
  
          switch (event.which) {
            // BACKSPACE
            case 8:
              if (doGetCaretPosition($input[0]) === 0) {
                var prev = $inputWrapper.prev();
                if (prev.length) {
                  self.remove(prev.data('item'));
                }
              }
              break;
  
            // DELETE
            case 46:
              if (doGetCaretPosition($input[0]) === 0) {
                var next = $inputWrapper.next();
                if (next.length) {
                  self.remove(next.data('item'));
                }
              }
              break;
  
            // LEFT ARROW
            case 37:
              // Try to move the input before the previous tag
              var $prevTag = $inputWrapper.prev();
              if ($input.val().length === 0 && $prevTag[0]) {
                $prevTag.before($inputWrapper);
                $input.focus();
              }
              break;
            // RIGHT ARROW
            case 39:
              // Try to move the input after the next tag
              var $nextTag = $inputWrapper.next();
              if ($input.val().length === 0 && $nextTag[0]) {
                $nextTag.after($inputWrapper);
                $input.focus();
              }
              break;
           default:
               // ignore
           }
  
          // Reset internal input's size
          var textLength = $input.val().length,
              wordSpace = Math.ceil(textLength / 5),
              size = textLength + wordSpace + 1;
          $input.attr('size', Math.max(this.inputSize, $input.val().length));
        }, self));
  
        self.$container.on('keypress', 'input', $.proxy(function(event) {
           var $input = $(event.target);
  
           if (self.$element.attr('disabled')) {
              self.$input.attr('disabled', 'disabled');
              return;
           }
  
           var text = $input.val(),
           maxLengthReached = self.options.maxChars && text.length >= self.options.maxChars;
           if (self.options.freeInput && (keyCombinationInList(event, self.options.confirmKeys) || maxLengthReached)) {
              // Only attempt to add a tag if there is data in the field
              if (text.length !== 0) {
                 self.add(maxLengthReached ? text.substr(0, self.options.maxChars) : text);
                 $input.val('');
              }
  
              // If the field is empty, let the event triggered fire as usual
              if (self.options.cancelConfirmKeysOnEmpty === false) {
                 event.preventDefault();
              }
           }
  
           // Reset internal input's size
           var textLength = $input.val().length,
              wordSpace = Math.ceil(textLength / 5),
              size = textLength + wordSpace + 1;
           $input.attr('size', Math.max(this.inputSize, $input.val().length));
        }, self));
  
        // Remove icon clicked
        self.$container.on('click', '[data-role=remove]', $.proxy(function(event) {
          if (self.$element.attr('disabled')) {
            return;
          }
          self.remove($(event.target).closest('.tag').data('item'));
        }, self));
  
        // Only add existing value as tags when using strings as tags
        if (self.options.itemValue === defaultOptions.itemValue) {
          if (self.$element[0].tagName === 'INPUT') {
              self.add(self.$element.val());
          } else {
            $('option', self.$element).each(function() {
              self.add($(this).attr('value'), true);
            });
          }
        }
      },
  
      /**
       * Removes all tagsinput behaviour and unregsiter all event handlers
       */
      destroy: function() {
        var self = this;
  
        // Unbind events
        self.$container.off('keypress', 'input');
        self.$container.off('click', '[role=remove]');
  
        self.$container.remove();
        self.$element.removeData('tagsinput');
        self.$element.show();
      },
  
      /**
       * Sets focus on the tagsinput
       */
      focus: function() {
        this.$input.focus();
      },
  
      /**
       * Returns the internal input element
       */
      input: function() {
        return this.$input;
      },
  
      /**
       * Returns the element which is wrapped around the internal input. This
       * is normally the $container, but typeahead.js moves the $input element.
       */
      findInputWrapper: function() {
        var elt = this.$input[0],
            container = this.$container[0];
        while(elt && elt.parentNode !== container)
          elt = elt.parentNode;
  
        return $(elt);
      }
    };
  
    /**
     * Register JQuery plugin
     */
    $.fn.tagsinput = function(arg1, arg2, arg3) {
      var results = [];
  
      this.each(function() {
        var tagsinput = $(this).data('tagsinput');
        // Initialize a new tags input
        if (!tagsinput) {
            tagsinput = new TagsInput(this, arg1);
            $(this).data('tagsinput', tagsinput);
            results.push(tagsinput);
  
            if (this.tagName === 'SELECT') {
                $('option', $(this)).attr('selected', 'selected');
            }
  
            // Init tags from $(this).val()
            $(this).val($(this).val());
        } else if (!arg1 && !arg2) {
            // tagsinput already exists
            // no function, trying to init
            results.push(tagsinput);
        } else if(tagsinput[arg1] !== undefined) {
            // Invoke function on existing tags input
              if(tagsinput[arg1].length === 3 && arg3 !== undefined){
                 var retVal = tagsinput[arg1](arg2, null, arg3);
              }else{
                 var retVal = tagsinput[arg1](arg2);
              }
            if (retVal !== undefined)
                results.push(retVal);
        }
      });
  
      if ( typeof arg1 == 'string') {
        // Return the results from the invoked function calls
        return results.length > 1 ? results : results[0];
      } else {
        return results;
      }
    };
  
    $.fn.tagsinput.Constructor = TagsInput;
  
    /**
     * Most options support both a string or number as well as a function as
     * option value. This function makes sure that the option with the given
     * key in the given options is wrapped in a function
     */
    function makeOptionItemFunction(options, key) {
      if (typeof options[key] !== 'function') {
        var propertyName = options[key];
        options[key] = function(item) { return item[propertyName]; };
      }
    }
    function makeOptionFunction(options, key) {
      if (typeof options[key] !== 'function') {
        var value = options[key];
        options[key] = function() { return value; };
      }
    }
    /**
     * HtmlEncodes the given value
     */
    var htmlEncodeContainer = $('<div />');
    function htmlEncode(value) {
      if (value) {
        return htmlEncodeContainer.text(value).html();
      } else {
        return '';
      }
    }
  
    /**
     * Returns the position of the caret in the given input field
     * http://flightschool.acylt.com/devnotes/caret-position-woes/
     */
    function doGetCaretPosition(oField) {
      var iCaretPos = 0;
      if (document.selection) {
        oField.focus ();
        var oSel = document.selection.createRange();
        oSel.moveStart ('character', -oField.value.length);
        iCaretPos = oSel.text.length;
      } else if (oField.selectionStart || oField.selectionStart == '0') {
        iCaretPos = oField.selectionStart;
      }
      return (iCaretPos);
    }
  
    /**
      * Returns boolean indicates whether user has pressed an expected key combination.
      * @param object keyPressEvent: JavaScript event object, refer
      *     http://www.w3.org/TR/2003/WD-DOM-Level-3-Events-20030331/ecma-script-binding.html
      * @param object lookupList: expected key combinations, as in:
      *     [13, {which: 188, shiftKey: true}]
      */
    function keyCombinationInList(keyPressEvent, lookupList) {
        var found = false;
        $.each(lookupList, function (index, keyCombination) {
            if (typeof (keyCombination) === 'number' && keyPressEvent.which === keyCombination) {
                found = true;
                return false;
            }
  
            if (keyPressEvent.which === keyCombination.which) {
                var alt = !keyCombination.hasOwnProperty('altKey') || keyPressEvent.altKey === keyCombination.altKey,
                    shift = !keyCombination.hasOwnProperty('shiftKey') || keyPressEvent.shiftKey === keyCombination.shiftKey,
                    ctrl = !keyCombination.hasOwnProperty('ctrlKey') || keyPressEvent.ctrlKey === keyCombination.ctrlKey;
                if (alt && shift && ctrl) {
                    found = true;
                    return false;
                }
            }
        });
  
        return found;
    }
  
    /**
     * Initialize tagsinput behaviour on inputs and selects which have
     * data-role=tagsinput
     */
    $(function() {
      $("input[data-role=tagsinput], select[multiple][data-role=tagsinput]").tagsinput();
    });
  })(window.jQuery);
  