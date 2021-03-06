/* jQuery showPassword Plugin Version 1.0
 * @author Byron Rode
 * @website http://www.prothemer.com/blog/2009/07/02/new-jquery-plugin-targeting-usability-for-password-masking-on-forms
 * @requires jQuery v1.3.x
 * @license GPL/MIT
 */

;(function($){
	$.fn.showPassword = function(ph, options){
	
		var spinput = $(this);
		
		$.fn.showPassword.checker = function(cbid, inid){
			$('input[id="'+cbid+'"]').click(function(){
				if($(this).attr('checked')){
					$('input.'+inid).val(spinput.val()).attr('id', spinput.attr('id')).attr('name',spinput.attr('name'));
					$('input.'+inid).css('display', 'inline');
					spinput.css('display', 'none').removeAttr('id').removeAttr('name');
				}else{
					spinput.val($('input.'+inid).val()).attr('id', $('input.'+inid).attr('id')).attr('name', $('input.'+inid).attr('name'));
					spinput.css('display', 'inline');
					$('input.'+inid).css('display', 'none').removeAttr('id').removeAttr('name');
				}
			});
		}
		
		return this.each(function(){
			var def = { classname: 'class', name: 'password-input', text: 'Show Password' };
			var spcbid = 'spcb_' + parseInt(Math.random() * 1000);
			var spinid = spcbid.replace('spcb_', 'spin_');
			if (spinput.attr('class') !== '') { var spclass = spinid+' '+spinput.attr('class'); }else{ var spclass = spinid; }
			if(typeof ph == 'object'){ $.extend(def, ph); }
			if(typeof options == 'object'){ $.extend(def, options); }
			var spname = def.name;
			// define the class name of the object
			if(def.classname==''){ theclass=''; }else{ theclass=' class="'+def.classname+'"'; }
			// build the checkbox
			$(this).before('<input type="text" value="" class="'+spclass+'" style="display: none;" />');
			var thecheckbox = '<label><input'+theclass+' type="checkbox" id="'+spcbid+'" name="'+spname+'" value="sp" />'+def.text+'</label>';
			// check if there is a request to place the checkbox in a specific placeholder. 
			// if not, place directly after the input.
			//if(ph == 'object' || typeof ph == 'undefined'){ $(this).after(thecheckbox); }else{ $(ph).html(thecheckbox); }
			$(this).after(thecheckbox);
			$.fn.showPassword.checker(spcbid, spinid);
			return this;
		});
	}
})
(jQuery);