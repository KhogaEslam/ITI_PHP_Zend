
<!-- header-bot -->
<div class="header-bot">
	<div class="container">
		<div class="col-md-3 header-left">
			<h1><a href="<?php $this->baseUrl() ?>">m<span>Z</span>one</a></h1>
		</div>
		<div class="col-md-6 header-middle">
			<form>
				<div class="search">
					<input type="search" value="Search" onfocus="this.value = '';" onblur="if (this.value == '') {this.value = 'Search';}" required="">
				</div>
				<div class="section_room">
					<select id="country" onchange="change_country(this.value)" class="frm-field required">
						<option value="null">All categories</option>
						<option value="null">Electronics</option>
						<option value="AX">kids Wear</option>
						<option value="AX">Men's Wear</option>
						<option value="AX">Women's Wear</option>
						<option value="AX">Watches</option>
					</select>
				</div>
				<div class="sear-sub">
					<input type="submit" value=" ">
				</div>
				<div class="clearfix"></div>
			</form>
		</div>
		<div class="col-md-3 header-right footer-bottom">
			<ul>
                <?php
                $authorization = Zend_Auth::getInstance();
                $storage=$authorization->getStorage();
                $userdata=$storage->read();
                ?>

                <?php if (!$authorization->hasIdentity()): ?>
				    <li><a href="<?php $this->baseUrl() ?>/user/login#" class="use1" data-toggle="modal" data-target="#myModal4"><span>Login</span></a></li>
                <?php elseif($userdata->type == 3): ?>
                    <li><a href="<?php $this->baseUrl() ?>/user/logout" class="use1" ><span>Logout</span></a></li>
                <?php elseif($userdata->type == 1 || $userdata->type == 2): ?>
                    <li><a href="<?php $this->baseUrl() ?>/dashboard" class="use1" ><span>Dashboard</span></a></li>
                <?php endif; ?>
				<li><a class="fb" href="#"></a></li>
				<li><a class="twi" href="#"></a></li>
				<li><a class="insta" href="#"></a></li>
				<li><a class="you" href="#"></a></li>
			</ul>
		</div>
		<div class="clearfix"></div>
	</div>
</div>
<!-- //header-bot -->

<!-- <input id='search_input' class='form-control' placeholder='search bar'> </input>
<div id='searchResult' style="width:100px; height:100px;"></div>
<button   id='search_btn'type='submit'> search </button> -->
<script>
    $('button#search_btn').on('click', function(){
        var search = $('input#search_input').val();
        if($.trim(search) != "") {
//        alert(search);
            $.post('/product/search', {name: search}, function(data){
                var parseData=JSON.parse(data);
                var htmlStr = "\\n\
              <div class='col-sm-4 col-md-4'>\
                   <div class='thumbnail'>\
                      <img src=" + parseData[0].image + " class='img-circle'>\
                       <div class='caption'>\
                           <h3>" + parseData[0].name + "</h3>\
                           <p><center><a href='#' class='btn btn-primary'\\n\
                            role='button'>View Category Products</a></center></p>\
                       </div>\
                   </div>\
               </div>"
                $('div#searchResult').html(htmlStr);
            });
        }

    });

</script>
