<?php include './components/foopagination.php'; ?>

<div class="page-info">
  Showing 1 of <?php echo $pages; ?>
</div>

<div class="bg-white p-4 flex items-center flex-wrap">
  <nav aria-label="Page navigation">
	<ul class="inline-flex">
	  <li>
      <button class="previous h-10 px-5 text-green-600 transition-colors duration-150 rounded-l-lg focus:shadow-outline hover:bg-green-100">
      <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
    </button>
	  </li>
	  <li>
      <button class="h-10 px-5 text-green-600 transition-colors duration-150 focus:shadow-outline hover:bg-green-100">1</button>
    </li>
	  <li>
      <button class="h-10 px-5 text-green-600 transition-colors duration-150 focus:shadow-outline hover:bg-green-100">2</button>
    </li>
	  <li>
      <button class="h-10 px-5 text-green-600 transition-colors duration-150 focus:shadow-outline hover:bg-green-100">3</button>
    </li>
	  <li>
      <button class="next h-10 px-5 text-green-600 transition-colors duration-150 bg-white rounded-r-lg focus:shadow-outline hover:bg-green-100">
      <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
      </button>
	  </li>
	</ul>
  </nav>
</div>
