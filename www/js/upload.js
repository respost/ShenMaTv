jQuery(function() {
    var $ = jQuery,
        $list = $('#thelist'),
        $btn = $('#ctlBtn'),
        state = 'pending',
        uploader;

    uploader = WebUploader.create({

        // ��ѹ��image
        resize: false,

        // swf�ļ�·��
        swf: '../../dist/Uploader.swf',
		    chunked: true,
            chunkSize: 2*1024*1024,
            // runtimeOrder: 'flash',
            sendAsBinary: true,
            chunkRetry: 0,
            threads: 1,
            duplicate: true,

        // �ļ����շ���ˡ�
        server: '/user/fileupload.php',
		    accept: {
            title: 'Images',
            extensions: 'mp4,flv',
            mimeTypes: '.mp4,.flv'
            },
            fileNumLimit: 1,
            fileSizeLimit: 200 * 1024 * 1024,    // 200 M
            fileSingleSizeLimit: 200 * 1024 * 1024,    // 50 M

        // ѡ���ļ��İ�ť����ѡ��
        // �ڲ����ݵ�ǰ�����Ǵ�����������inputԪ�أ�Ҳ������flash.
        pick: '#picker'
    });

    // �����ļ���ӽ�����ʱ��
    uploader.on( 'fileQueued', function( file ) {
        $list.append( '<div id="' + file.id + '" class="item">' +
            '<h4 class="info">' + file.name + '</h4>' +
            '<p class="state">�ȴ��ϴ�...</p>' +
        '</div>' );
		$( '#picker').css( 'display', 'none' );
    });

    // �ļ��ϴ������д���������ʵʱ��ʾ��
    uploader.on( 'uploadProgress', function( file, percentage ) {
        var $li = $( '#'+file.id ),
            $percent = $li.find('.progress .progress-bar');

        // �����ظ�����
        if ( !$percent.length ) {
            $percent = $('<div class="progress progress-striped active">' +
              '<div class="progress-bar" role="progressbar" style="width: 0%">' +
              '</div>' +
            '</div>').appendTo( $li ).find('.progress-bar');
        }

        $li.find('p.state').text('�ϴ���');

        $percent.css( 'width', percentage * 100 + '%' );
    });

    uploader.on( 'uploadSuccess', function( file ) {
        $( '#'+file.id ).find('p.state').text('���ϴ�');
		$( '#ctlBtn').css( 'display', 'none' );
    });

    uploader.on( 'uploadError', function( file ) {
        $( '#'+file.id ).find('p.state').text('�ϴ�����');
    });

    uploader.on( 'uploadComplete', function( file ) {
        $( '#'+file.id ).find('.progress').fadeOut();
    });
	
	uploader.on('uploadSuccess',function(file,response){
        var fileurl = response.fileurl; //�ϴ��ļ���·��
		var title = response.title; //�ϴ��ļ�������
		var spurl = document.getElementById('url').value;
		document.getElementById('url').value=fileurl;
		document.getElementById('name').value=title;
        });

    uploader.on( 'all', function( type ) {
        if ( type === 'startUpload' ) {
            state = 'uploading';
        } else if ( type === 'stopUpload' ) {
            state = 'paused';
        } else if ( type === 'uploadFinished' ) {
            state = 'done';
        }

        if ( state === 'uploading' ) {
            $btn.text('��ͣ�ϴ�');
        } else {
            $btn.text('��ʼ�ϴ�');
        }
    });

    $btn.on( 'click', function() {
        if ( state === 'uploading' ) {
            uploader.stop();
        } else {
            uploader.upload();
        }
    });
});
