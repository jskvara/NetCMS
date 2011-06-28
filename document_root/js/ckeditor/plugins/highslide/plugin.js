(function(){
	CKEDITOR.plugins.add('highslide', {
		init: function(editor) {
			editor.addCommand('insertHighslide', {
				exec: function(editor) {
					var sel = editor.getSelection(),
						img = sel.getSelectedElement();
					var url = img.getAttribute('src');
					url = url.replace('-thumb.', '.');
					var link = CKEDITOR.dom.element.createFromHtml('<a></a>', editor.document);
					link.setAttributes({'class': 'highslide', 'href': url, 'onclick': 'return hs.expand(this)'});
					img.appendTo(link);
					
					editor.insertElement(link);
				}
			});
			
			if(editor.addMenuItems) {
				editor.addMenuItems({
					addHighslide: {
						label: 'Highslide', 
						command: 'insertHighslide',
						group: 'highslide',  // have to be added in config
					}
				});
			}

			if(editor.contextMenu) {
				editor.contextMenu.addListener(function(element, selection) {
					if(!element || !element.is('img')) {
						return null;
					}
					return { addHighslide: CKEDITOR.TRISTATE_OFF };
				});
			}
		}
	});
})();
