// Code By Webdevtrick ( https://webdevtrick.com )
function readFile(input, id) {
    if (input.files && input.files[0]) {
      if(/*input.files[0].type == 'application/pdf' &&*/ input.files[0].size <= 3000000) {
        
        var reader = new FileReader();
    
        reader.onload = function(e) {
          var url = e.target.result;
          var htmlPreview =
            `<img class="img-thumbnail" src="${ input.files[0].type != 'application/pdf' ? url : '/smartadmin-4.5.1/img/pdf-icon.png'}" style="max-width: 75px;" />` +
            '<p>' + input.files[0].name + '</p>';
          var wrapperZone = $(input).parent();
          var previewZone = $(input).parent().parent().find('.preview-zone');
          var boxZone = $(input).parent().parent().find('.preview-zone').find('.box').find(`#${id}`);
    
          wrapperZone.removeClass('dragover');
          previewZone.removeClass('hidden');
          boxZone.empty();
          boxZone.append(htmlPreview);
          url = '';
        };
    
        reader.readAsDataURL(input.files[0]);
        $('#alert-pdf-format').html('');
      }
      else {
        $('#alert-pdf-format').html('<span class="text-warning font-size-14">Desculpe! O arquivo deve ter no máximo 30MB.</span>');
        $('.box-body').empty();
        $('.preview-zone').addClass('hidden');
      }
    }
  }
   
  function reset(e) {
    e.wrap('<form>').closest('form').get(0).reset();
    e.unwrap();
  }
   
  $("#comprovante_arquivo").change(function() {
    readFile(this, 'comprovante-box-body');
  });

  $("#projeto_arquivo").change(function() {
    readFile(this, 'projeto-box-body');
  });

  $("#edital_arquivo").change(function() {
    readFile(this, 'edital-box-body');
  });

  $("#edital_imagem").change(function() {
    readFile(this, 'imagem-box-body');
  });
   
  $('.dropzone-wrapper').on('dragover', function(e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).addClass('dragover');
  });
   
  $('.dropzone-wrapper').on('dragleave', function(e) {
    e.preventDefault();
    e.stopPropagation();
    $(this).removeClass('dragover');
  });
   
  $('.remove-preview').on('click', function() {
    var boxZone = $(this).parents('.preview-zone').find('.box-body');
    var previewZone = $(this).parents('.preview-zone');
    var dropzone = $(this).parents('.form-group').find('.dropzone');
    boxZone.empty();
    previewZone.addClass('hidden');
    reset(dropzone);
  });