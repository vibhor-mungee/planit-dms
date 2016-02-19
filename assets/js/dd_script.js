$(document).ready(function(){
document.getElementById('district_btn').disabled=true;
document.getElementById('taluk_btn').disabled=true;
document.getElementById('village_btn').disabled=true;
	var base_url = window.location.origin;	
	$.ajax({
            type:'GET',
            url:base_url+'/planit/api/selection_api/states',
            datatype: JSON,
            success:function(data){
		var len = data.length;
		for(var i=0;i<len;i++){
                	$('#states').append('<li><a  href="#" id='+data[i].ST_ID+'>'+data[i].ST_NAME+'</a></li>');
                }
	     }
          });
$('#states').on('click','a',function(e){
	 var state_id = $(this).attr("id");
	 e.preventDefault();
	 if(state_id){
	  $('#state_btn').text($(this).text());
	  $.ajax({
            type:'GET',
            url:'/planit/api/selection_api/districts',
            datatype: JSON,
            data:{'state_id':state_id},
            success:function(data){
		$('#districts').empty();
		for(var i=0;i<data.length;i++){
			$('#districts').append('<li><a href="#" id='+data[i].DS_ID+'>'+data[i].DS_NAME+'</a></li>');
		}
		document.getElementById('district_btn').disabled=false;
		$('#district_btn').text('Select District');
		document.getElementById('taluk_btn').disabled=true;
		$('#taluk_btn').text('Select Taluk');
		document.getElementById('village_btn').disabled=true;
		$('#village_btn').text('Select Village');
	    }
          });
	 }
	 else{
	 }
});

$('#districts').on('click','a',function(e){
        var districtID = $(this).attr("id");
	e.preventDefault();
	if(districtID){
	    $('#district_btn').text($(this).text());;
            $.ajax({
                type:'GET',
                url:'/planit/api/selection_api/taluks',
		datatype: JSON,
                data:{'district_id':districtID},
                success:function(data){
		    $('#taluks').empty();
		    for(var i=0;i<data.length;i++){
                        $('#taluks').append('<li><a href="#" id='+data[i].TL_ID+'>'+data[i].TL_NAME+'</a></li>');
                    }
                document.getElementById('taluk_btn').disabled=false;
                $('#taluk_btn').text('Select Taluk');
                document.getElementById('village_btn').disabled=true;
                $('#village_btn').text('Select Village');
                }
            }); 
        }else{
        }
    });	

$('#taluks').on('click','a',function(e){
        var talukID = $(this).attr('id');
	e.preventDefault();
	if(talukID){
	    $('#taluk_btn').text($(this).text());
            $.ajax({
                type:'GET',
                url:'/planit/api/selection_api/villages',
		datatype: JSON,
                data:{'taluk_id':talukID},
                success:function(data){
		    $('#villages').empty();
                    for(var i=0;i<data.length;i++){
                        $('#villages').append('<li><a href="#" id='+data[i].VI_ID+'>'+data[i].VI_NAME+'</a></li>');
                    }
		document.getElementById('village_btn').disabled=false;
		$('#village_btn').text('Select Village');
                }
            });
        }else{
        }
    
});
var villageID;
$('#villages').on('click','a',function(e){
	villageID = $(this).attr('id');
	e.preventDefault();
	if(villageID){
		$('#village_btn').text($(this).text());
		document.getElementById('submit').disabled=false;
	}
});
$('#submit').on('click',function(){
	//var villageID = $('#villages li a').attr('id');
	if(villageID){
		$.ajax({
    		type : 'POST',
    		data : {'villageid':villageID},
    		url : '/planit/village',
    		success :   function(response){
			if( response.status === true )
            			document.location.href = response.redirect;
        		else 
            		        $('#show_id').html("<div style='border:1px solid red;font-size: 11px;margin:0 auto !important;'>"+response.error+"</div>");                	
    		}
		});
	} else {
		alert("Invalid village selected");
	}
	});
});
