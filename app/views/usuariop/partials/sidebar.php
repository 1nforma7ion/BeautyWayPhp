		<nav class="hidden md:flex  flex-col w-full text-white rounded-xl text-xl font-dmsans">
			<?php foreach($data['sidebar'] as $item) : ?>
				<li class="list-none  hover:border-white">
					
					<a class="py-3 px-6 flex justify-between items-center <?php echo  ($data['page'] ==  ltrim($item->menu_item_url, "/")	) ? 'is-active' : 'is-inactive'; ?>" href="<?php echo URLROOT . '/' . $data['controller'] . $item->menu_item_url ?>">
						 <span><?php echo $item->menu_item_text ?></span><i class="fas <?php echo $item->menu_item_icon ?>"></i>  
					</a>
				</li>
			<?php endforeach; ?>
		</nav>	

