<?php include './components/foo.php'; ?>
<?php include './components/foopagination.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script src="https://cdn.tailwindcss.com"></script>
  <script>
    tailwind.config = {
      theme: {
        extend: {
          colors: {
            primary: '#7856ff'
          }
        }
      }
    }
  </script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <style>
    body {
      padding: 0 calc(20px - (100vw - 100%)) 0 0;
    }
    .pageinfo {
      display: flex;
      gap: 2px;
    }
    .modal-open {
      overflow: hidden;
    }
    .crypto-modal {
      transition: all .18s ease-in-out;
      transform: scale(.9);
      visibility: hidden;
	    opacity: 0;
    }
    .modal-me {
      transform: translate(0%, 50%);
    }

    .nav-wrapper {
      margin-top: 1rem;
    }
    .search-and-pagination-wrapper {
      flex-direction: row-reverse;
    }

    @media (hover: hover) {
    .previous:hover,
    .next:hover {
    background-color: #A1B3FB;
    color: #4E48E5;
    }
    }

    @media (hover: none) {
    .previous:active,
    .next:active {
    background-color: #A1B3FB;
    color: #4E48E5;
    }
    }

    @media (max-width: 632px) {
      #selectidtwo {
        margin-top: 0.4rem;
      }
    }

    @media (max-width: 449px) {
      body {
        padding: 0 !important;
      }
      main {
        padding-left: 0.2em !important;
        padding-right: 0.2em !important;
      }
      #titlenotes {
        margin-left: 10px !important;
      }
      .search-and-pagination-wrapper {
        flex-wrap: wrap;
      }
      .select-container {
        justify-content: space-between;
        display: flex;
        flex-wrap: wrap;
      }
    }

    /* @media (max-width: 364px) { */
    @media (max-width: 413px) {
      .form-search-container {
        margin-left: 0;
      }
      .search-and-pagination-wrapper {
        display: block !important;
      }
      #selectid,
      #selectidtwo {
        width: 100%;
      }
      .form-control {
        width: 100%;
      }
    }

    @media (max-width: 347px) {
      .form-search-container {
        margin-left: 0;
      }
    }

  </style>
<title>test notes</title>
</head>
<body style="background: #ebf0fa; padding: 0 calc(20px - (100vw - 100%)) 0 0">
  <main class="max-w-5xl my-12 mx-auto px-8">
  <h1 id="titlenotes" class="font-bold text-primary text-lg">Notes</h1>
  <div class="container mx-auto lg px-4">
  <!-- CURRENT PAGE INFO -->
  <div class="pageinfo">
  <p id="currentpageinfo">Текущая страница: 1</p>
  <p id="allpagesinfo">из <?php echo $pages;?></p>
  </div>
  <!-- CURRENT PAGE INFO -->
  <!-- SELECT START-->
  <?php require_once "select.php" ?>
  <!-- SELECT END -->
  <div class="search-and-pagination-wrapper flex items-center justify-between">
    <!-- SEARCH -->
    <?php require_once "searchform.php" ?>
    <!-- SEARCH -->
  <!-- PAGINATION START-->
  <?php require_once "paginationtwovar.php" ?>
  <!-- PAGINATION START-->
  </div>
  <div id="alldata">
  <p id="pagecount" data-action="1"></p>
  <p id="allpages" data-action="<?php echo $pages;?>"></p>
  <?php foreach ($result as $res) { ?>
    <div id="<?php echo $res->id; ?>" class="card my-5 bg-white shadow-sm rounded-md py-3 px-4 my-4 relative overflow-hidden" >
      <h3 id="information" class="font-bold text-gray-700 text-sm mb-0"><?php echo $res->title; ?></h3>
      <p class="my-4 text-sm leading-6" style="overflow-wrap: anywhere;"><?php echo $res->body; ?></p>
      <?php if ($res->priority === 'low'): ?>
        <div class='pill absolute bottom-0 right-0 rounded-tl-md bg-emerald-300 text-emerald-600 py-1 px-2 mt-3 inline-block text-xs font-semibold'>
        <button onclick="openModal()" class="button" type="button" data-action="<?php echo $res->id; ?>" data-modal-target="crypto-modal<?php echo $res->id; ?>" data-modal-toggle="crypto-modal"><?php echo $res->priority; ?> priority</a></button>
        </div>
      <?php endif ?>
      <?php if ($res->priority === 'middle'): ?>
        <div class='pill absolute bottom-0 right-0 rounded-tl-md bg-orange-300 text-orange-600 py-1 px-2 mt-3 inline-block text-xs font-semibold'>
        <button onclick="openModal()" class="button" type="button" data-action="<?php echo $res->id; ?>" data-modal-target="crypto-modal<?php echo $res->id; ?>" data-modal-toggle="crypto-modal"><?php echo $res->priority; ?> priority</a></button>
        </div>
      <?php endif ?>
      <?php if ($res->priority === 'high'): ?>
        <div class='pill absolute bottom-0 right-0 rounded-tl-md bg-indigo-300 text-indigo-600 py-1 px-2 mt-3 inline-block text-xs font-semibold'>
        <button onclick="openModal()" class="button" type="button" data-action="<?php echo $res->id; ?>" data-modal-target="crypto-modal<?php echo $res->id; ?>" data-modal-toggle="crypto-modal"><?php echo $res->priority; ?> priority</a></button>
        </div>
      <?php endif ?>
      <p class="text-sm text-gray-700 text-sm"><?php echo $res->author; ?></p>
      <!-- Main modal -->
    
    <div id="crypto-modal<?php echo $res->id; ?>" tabindex="-1" aria-hidden="true" class="crypto-modal overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="modal-me absolute p-4 w-full max-w-md max-h-full m-auto right-0 left-0">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                  Change note priority #id <?php echo $res->id; ?>
                </h3>
                <button onclick="closeModal()" data-action="<?php echo $res->id; ?>" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crypto-modal">
                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                    </svg>
                    <span class="sr-only">Close modal</span>
                </button>
            </div>
            <!-- Modal body -->
            <div class="p-4 md:p-5">
                <p class="text-sm font-normal text-gray-500 dark:text-gray-400">Select new priority</p>
                <div class="form-container">
                <form id="input-form">
                  <label class="flex bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3  hover:bg-indigo-300">
                      <input type="radio" name="priority" id="high" value="high">
                      <span class="pl-2">High</span>
                  </label>
                  <label class="flex bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3  hover:bg-indigo-300">
                      <input type="radio" name="priority" id="middle" value="middle">
                      <span class="pl-2">Middle<span>
                  </label>
                  <label class="flex bg-gray-100 text-gray-700 rounded-md px-3 py-2 my-3  hover:bg-indigo-300">
                      <input type="radio" name="priority" id="low" value="low" checked="checked">
                      <span class="pl-2">Low</span>
                    </label>
                    <input type="hidden" name="priorityid" id="priorityid" value="">
                    <button onclick="handleSub()" value="submit" id="sub" type="submit" data-action="<?php echo $res->id; ?>" class="btn bg-blue-500 font-bold py-2 px-4 rounded mt-2 text-white hover:bg-blue-700">Post</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
    </div>
    <?php } ?>
  </div>
  </div>
<script>

      window.onload = function() {
        localStorage.removeItem('selectAuthor');
        localStorage.removeItem('selectPriority');
        localStorage.removeItem('searchvalue');
      }
      
      const getInputValue = (event) => {
        event.preventDefault();
      }
      
      const searchForm = document.querySelector('.app-header-search');
      searchForm.addEventListener('submit', getInputValue);

      searchForm.search.addEventListener('keyup', () => {
        if (event.key === 'Backspace') {
          return;
        }
        if(searchForm.search.value.length >= 1) {
          handleSearch(searchForm.search.value);
        } else {
          return;
        }
      });

      searchForm.addEventListener('keydown', function(event) {
        if (event.code == 'ENTER' && (searchForm.search.value.length > 1)) {
          handleSearch(searchForm.search.value);
        } else {
          return;
        }
      });

      // основная функция обработки радио инпутов и ajax отправка запроса
      function handleSub(e) {
        const selectId = document.getElementById('selectidtwo');
        const selectValue = selectId.value;
      // отменяем стандартные действия для всех форм на странице при событии submit
        const formElement = document.querySelectorAll('#input-form');
        formElement.forEach(function(f) {
        f.addEventListener('submit', (e) => {
          e.preventDefault();
          })
        });
        const t2 = event.target.parentElement;
        const t2dataset = event.target.dataset.action;
        let radios = t2.querySelectorAll('input[type="radio"]');
        for (let radio of radios) {
        if (radio.checked) {
          const radioVal = radio.value;
          $.ajax({
          type: "POST",
          url: 'http://localhost:8080/components/foo.php',
          data: {
            priority:radioVal,
            priorityid:Number(t2dataset)
          },
          success: function() {
            const closeTarget = document.getElementById("crypto-modal"+t2dataset);
            closeTarget.style  = "visibility: hidden; opacity: 0; transition: opacity 200ms; scale(.9);";
            document.body.classList.remove('modal-open');
            const priorityIdElement = document.getElementById(t2dataset);
            const btnPriority = priorityIdElement.querySelector('button');
            btnPriority.innerHTML = `${radioVal} priority`;
            const btnNewPriority = priorityIdElement.querySelector('button');
            if (btnNewPriority.innerHTML === 'middle priority') {
              if (btnNewPriority.parentElement.classList.contains('bg-indigo-300')) {
                btnNewPriority.parentElement.classList.replace('bg-indigo-300', 'bg-orange-300')
                btnNewPriority.parentElement.classList.replace('text-indigo-600', 'text-orange-600')
              }
              if (btnNewPriority.parentElement.classList.contains('bg-emerald-300')) {
                btnNewPriority.parentElement.classList.replace('bg-emerald-300', 'bg-orange-300')
                btnNewPriority.parentElement.classList.replace('text-emerald-600', 'text-orange-600')
              }
            }
            else if (btnNewPriority.innerHTML === 'high priority') {
              if (btnNewPriority.parentElement.classList.contains('bg-orange-300')) {
                btnNewPriority.parentElement.classList.replace('bg-orange-300', 'bg-indigo-300')
                btnNewPriority.parentElement.classList.replace('text-orange-600', 'text-indigo-600')
              }
              if (btnNewPriority.parentElement.classList.contains('bg-emerald-300')) {
                btnNewPriority.parentElement.classList.replace('bg-emerald-300', 'bg-indigo-300')
                btnNewPriority.parentElement.classList.replace('text-emerald-600', 'text-indigo-600')
              }
            }
            else if (btnNewPriority.innerHTML === 'low priority') {
              if (btnNewPriority.parentElement.classList.contains('bg-orange-300')) {
                btnNewPriority.parentElement.classList.replace('bg-orange-300', 'bg-emerald-300')
                btnNewPriority.parentElement.classList.replace('text-orange-600', 'text-emerald-600')
              }
              if (btnNewPriority.parentElement.classList.contains('bg-indigo-300')) {
                btnNewPriority.parentElement.classList.replace('bg-indigo-300', 'bg-emerald-300')
                btnNewPriority.parentElement.classList.replace('text-indigo-600', 'text-emerald-600')
              }
            }
            if (selectValue == 'low') {
              if (btnNewPriority.innerHTML === 'high priority' || btnNewPriority.innerHTML === 'middle priority') {
                priorityIdElement.style.display = 'none';
              }
            }
            else if (selectValue == 'middle') {
              if (btnNewPriority.innerHTML === 'low priority' || btnNewPriority.innerHTML === 'high priority') {
                priorityIdElement.style.display = 'none';
              }
            }
            else if (selectValue == 'high') {
              if (btnNewPriority.innerHTML === 'middle priority' || btnNewPriority.innerHTML === 'low priority') {
                priorityIdElement.style.display = 'none';
              }
            }
          }
        });
        }
        }
      }

    $(document).ready(function(){
    let dataGet = false;
    $('#selectid').change(function(){
    const selectAuthor = $('#selectid').val();
    const searchform = document.querySelector('#input-form');
    localStorage.removeItem('searchvalue');
    searchform.reset()
    localStorage.setItem('selectAuthor', selectAuthor);
    const selectPriority = $('#selectidtwo');
    selectPriority[0].value = 'all';
    const currentpageinfo = document.getElementById('currentpageinfo');
    currentpageinfo.innerText = `Текущая страница: 1`;
    $("#alldata").html(`
    <div class="mt-4 flex items-center">
    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-indigo-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
    <p class="text-gray-700">Loading...</p>
    </div>
    `);
    setTimeout(() => {
      $.ajax({
          type: "POST",
          url: 'http://localhost:8080/components/footwo.php',
          data: {
            author:selectAuthor,
          },
          success: function(data) {
           if (data) {
            dataGet = true;
            $("#alldata").html(data);
            const allpages = document.getElementById('allpages');
            if (allpages === null) {
              const allpagesinfo = document.getElementById('allpagesinfo');
              allpagesinfo.innerText = `из 1`;
            } else if (allpages !== null) {
              const allPagesDataSet = allpages.dataset.action;
              const allpagesinfo = document.getElementById('allpagesinfo');
              allpagesinfo.innerText = `из ${allPagesDataSet}`;
            }
            if (data.length === 2) {
              const nodataHtml = `<div class="mt-2">
              <h3 class="font-bold text-gray-700 text-sm mb-0">Ничего не выбрано - выберите приоритет, автора или перезагрузите страницу</h3>
              </div>`
              $("#alldata").html(nodataHtml);
            }
           }
          }
        });
    }, 250);
        })
    })

    $(document).ready(function(){
    let dataGetTwo = false;
    $('#selectidtwo').change(function(){
    const selectPriority = $('#selectidtwo').val();
    const searchform = document.querySelector('#input-form');
    localStorage.removeItem('searchvalue');
    searchform.reset();
    localStorage.setItem('selectPriority', selectPriority);
    const currentpageinfo = document.getElementById('currentpageinfo');
    currentpageinfo.innerText = `Текущая страница: 1`;
    $("#alldata").html(`
    <div class="mt-4 flex items-center">
    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-indigo-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
    <p class="text-gray-700">Loading...</p>
    </div>
    `);
    if (selectPriority !== 'Выбор приоритета' && localStorage.getItem('selectAuthor') !== null && localStorage.getItem('selectAuthor') !== undefined && localStorage.getItem('selectAuthor') !== 'Выбор автора') {
      const authorFromLocal = localStorage.getItem('selectAuthor');
      setTimeout(() => {
        $.ajax({
          type: "POST",
          url: 'http://localhost:8080/components/foothree.php',
          data: {
            priority:selectPriority,
            author:authorFromLocal,
          },
          success: function(data) {
           if (data) {
            dataGetTwo = true;
            $("#alldata").html(data);
            if (data.length === 2) {
              const nodataHtml = `<div class="mt-2">
              <h3 class="font-bold text-gray-700 text-sm mb-0">Ничего не найдено - выберите другой приоритет, автора или перезагрузите страницу</h3>
              </div>`
              $("#alldata").html(nodataHtml);
            }
           } 
          }
        });
      }, 250);
      }
      else {
        setTimeout(() => {
          $.ajax({
            type: "POST",
            url: 'http://localhost:8080/components/foofour.php',
            data: {
              priority:selectPriority,
            },
            success: function(data) {
            if (data) {
              dataGetTwo = true;
              $("#alldata").html(data);
              const allpages = document.getElementById('allpages').dataset.action;
              const allpagesinfo = document.getElementById('allpagesinfo');
              allpagesinfo.innerText = `из ${allpages}`;
              if (data.length === 2) {
                const nodataHtml = `<div class="mt-2">
                <h3 class="font-bold text-gray-700 text-sm mb-0">Ничего не найдено - выберите другой приоритет, автора или перезагрузите страницу</h3>
                </div>`
                $("#alldata").html(nodataHtml);
              }
            } 
            }
          });
        }, 250);
      }
        })
    })

    function handleSearch(searchValue) {
    localStorage.setItem('searchvalue', searchValue);
    const selectPriority = $('#selectidtwo');
    selectPriority[0].value = 'Выбор приоритета';
    const selectAuthor = $('#selectid');
    selectAuthor[0].value = 'Выбор автора';
    const currentpageinfo = document.getElementById('currentpageinfo');
    currentpageinfo.innerText = `Текущая страница: 1`;
    $("#alldata").html(`
    <div class="mt-4 flex items-center">
    <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-indigo-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
    <p class="text-gray-700">Loading...</p>
    </div>
    `);
    setTimeout(() => {
      $.ajax({
          type: "POST",
          url: 'http://localhost:8080/components/foosearch.php',
          data: {
            search:searchValue,
          },
          success: function(data) {
           if (data) {
            $("#alldata").html(data);
            const allpages = document.getElementById('allpages').dataset.action;
            const allpagesinfo = document.getElementById('allpagesinfo');
            allpagesinfo.innerText = `из ${allpages}`;
            if (data.length === 2) {
              const nodataHtml = `<div class="mt-2">
              <h3 class="font-bold text-gray-700 text-sm mb-0">Ничего не найдено - введите новое значение</h3>
              </div>`
              $("#alldata").html(nodataHtml);
            }
           }
          }
        });
    }, 500);
        }
  
  function handleNext() {
    $(document).ready(function(){
    const pagecount = document.getElementById('pagecount');
    if (pagecount !== null) {
    const currentPage = Number(pagecount.dataset.action);
    const currentpageinfo = document.getElementById('currentpageinfo');
    const pages = allpages.dataset.action;
    const selectPriorityForNext = $('#selectidtwo').val();
    const searchValueForNext = localStorage.getItem('searchvalue');
    let lockNext = false;
    console.log('All page', pages)
    if (currentPage >= pages) {
      lockNext = true;
    }

    if (!lockNext) {
      $("#alldata").html(`
      <div class="mt-4 flex items-center">
      <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-indigo-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
      <p class="text-gray-700">Loading...</p>
      </div>
      `);
      setTimeout(() => {
      currentpageinfo.innerText = `Текущая страница: ${currentPage + 1}`;
      $.ajax({
        type: "POST",
        url: 'http://localhost:8080/components/foopagination.php',
        data: {
          currentpage:currentPage - 1,
          prioritynext:selectPriorityForNext,
          searchvaluenext:searchValueForNext
        },
        success: function(data) {
        if (data) {
          $("#alldata").html(data);
        } 
        }
      })
    }, 100);
    }
    }
    }
    )
  }

  function handlePrevious() {
    $(document).ready(function(){
    const pagecount = document.getElementById('pagecount');
    if (pagecount !== null) {
    const currentPage = Number(pagecount.dataset.action);
    const currentpageinfo = document.getElementById('currentpageinfo');
    const allpages = document.getElementById('allpages');
    const pages = allpages.dataset.action;
    const selectPriorityForNext = $('#selectidtwo').val();
    const searchValueForPrevious = localStorage.getItem('searchvalue');
    let lockNext = false;
    if (currentPage <= 1) {
      lockNext = true;
    }

    if (!lockNext && currentPage > 1) {
      $("#alldata").html(`
      <div class="mt-4 flex items-center">
      <svg class="animate-spin -ml-1 mr-3 h-5 w-5 text-indigo-300" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"><circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle><path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path></svg>
      <p class="text-gray-700">Loading...</p>
      </div>
      `);
      setTimeout(() => {
      currentpageinfo.innerText = `Текущая страница: ${currentPage - 1}`;
      $.ajax({
        type: "POST",
        url: 'http://localhost:8080/components/foopagination.php',
        data: {
          nextpage:currentPage - 1,
          priorityprev:selectPriorityForNext,
          searchvalueprevious:searchValueForPrevious
        },
        success: function(data) {
        if (data) {
          $("#alldata").html(data);
        } 
        }
      })
    }, 100);
    }
    }
    }
    )
  }

  function openModal() {
    const t = event.target.dataset.action;
    const modal3 = document.getElementById("crypto-modal"+t);
    const modalme = modal3.querySelector(".modal-me");
    document.addEventListener('click', function(e) {
      e.stopPropagation();
      if (event.target == modal3 || event.target == modalme) {
        modal3.style = "visibility: hidden; opacity: 0; transition: opacity 200ms; scale(.9);";
        document.body.classList.remove('modal-open');
      }
    })
    const priorityId = modal3.querySelector("#priorityid");
    priorityId.setAttribute('value', `${t}`);
    modal3.style = "visibility: visible; opacity: 1; scale(1);";
    document.body.classList.add('modal-open');
  }

  function closeModal() {
    const t2 = event.currentTarget.dataset.action;
    const modal4 = document.getElementById("crypto-modal"+t2);
    modal4.style = "visibility: hidden; opacity: 0; transition: opacity 200ms; scale(.9);";
    document.body.classList.remove('modal-open');
  }

</script>
  </main>
</body>
</html>
