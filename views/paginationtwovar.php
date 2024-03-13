<?php include './components/foopagination.php'; ?>

  <div class="nav-wrapper inline-flex">
  <nav class="nav-pagination" aria-label="Page navigation">
	<ul class="ul-pagination inline-flex gap-1">
	  <li id="li-previous">
      <button onclick="handlePrevious()" id="previous" class="previous rounded-full h-10 px-5 text-indigo-600 transition-colors duration-150 bg-white focus:shadow-outline ">
      <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M12.707 5.293a1 1 0 010 1.414L9.414 10l3.293 3.293a1 1 0 01-1.414 1.414l-4-4a1 1 0 010-1.414l4-4a1 1 0 011.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
    </button>
	  </li>
	  <li id="li-next">
      <button onclick="handleNext()" id="next" class="next rounded-full h-10 px-5 text-indigo-600 transition-colors duration-150 bg-white focus:shadow-outline ">
      <svg class="w-4 h-4 fill-current" viewBox="0 0 20 20"><path d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z" clip-rule="evenodd" fill-rule="evenodd"></path></svg>
      </button>
	  </li>
	</ul>
  </nav>
 </div>
