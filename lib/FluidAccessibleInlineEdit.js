var demo = demo || {};
(function ($, fluid) {
    
    demo.undoRenderer = function (that, targetContainer) {
        var markup = 
            "<span class='flc-undo'>" +
            "<span class='demo-undoContainer' role='button'><a href='#' class='demo-undoControl'><img src='../images/inline_edit_undo_button_16x16.png' alt='Undo edit'></a></span>" +
            "<span class='demo-redoContainer' role='button'><a href='#' class='demo-redoControl'><img src='../images/inline_edit_redo_button_16x16.png' alt='Redo edit'></a></span>" +
            "</span>";
        var markupNode = $(markup);
        targetContainer.append(markupNode);
        return markupNode;
    };
    
    /**
     * Initialize all simple inline edit components present on the inline-edit 
     * demo.
     */
    demo.initInlineEdit = function () {
          
        /**
         * Simple inline edits example.
         */
            
        fluid.inlineEdit(".demoSelector-inlineEdit-container-title", {
            componentDecorators: {
                type: "fluid.undoDecorator",
                options: {
                    selectors: demo.initInlineEdit.selectors,
                    renderer: demo.undoRenderer
                }
            },
            styles: {
                edit: "demo-inlineEdit-title-edit demo-inlineEdit-edit"
            },
            defaultViewText: "Edit this"
        });
        
        fluid.inlineEdit(".demoSelector-inlineEdit-container-caption", {
            componentDecorators: {
                type: "fluid.undoDecorator",
                options: {
                    selectors: demo.initInlineEdit.selectors,
                    renderer: demo.undoRenderer
                }
            },
            defaultViewText: "Edit this"
        });
    };
        
    demo.initInlineEdit.selectors = {
        undoContainer: ".demo-undoContainer",
        undoControl: ".demo-undoControl",
        redoContainer: ".demo-redoContainer",
        redoControl: ".demo-redoControl"
    };    
})(jQuery, fluid);