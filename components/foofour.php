<?php

include 'db.php';

$pages = null;
$starttwo = 0;
$rowperpage = 4;
$page = null;

$countsql = $pdo->prepare("SELECT COUNT(*) FROM notes");
$countsql->execute();
$countresult = $countsql->fetchColumn();
$pages = ceil($countresult / $rowperpage);

$query = null;
$starnewpage = 1;
$currentpage = null;

if (isset($_POST["priority"])) {
  $rowperpage = 4;
  $page = 0;
  if ($_POST["priority"] !== 'all') {
    $priority = $_POST["priority"];
    $countsql = $pdo->prepare("SELECT COUNT(*) FROM notes WHERE priority=?");
    $countsql->execute([$priority]);
    $countresult = $countsql->fetchColumn();
    $pages = ceil($countresult / $rowperpage);
    $sql = "SELECT * FROM notes WHERE priority=? LIMIT $page, $rowperpage";
    $query = $pdo->prepare($sql);
    $query->execute([$priority]);
  } 
  else {
    $priority = $_POST["priority"];
    $countsql = $pdo->prepare("SELECT COUNT(*) FROM notes");
    $countsql->execute();
    $countresult = $countsql->fetchColumn();
    $pages = ceil($countresult / $rowperpage);
    $sql = "SELECT * FROM notes LIMIT $page, $rowperpage";
    $query = $pdo->prepare($sql);
    $query->execute();
  }
}
?>

<?php
 if ($query !== null) {
  ?>
<p id="pagecount" data-action="<?php echo $starnewpage;?>"></p>
<p id="allpages" data-action="<?php echo $pages;?>"></p>
  <?php
 }
?>

<?php
 if ($priority === 'Выбор приоритета') {
  ?>
    <div class="mt-2">
      <h3 class="font-bold text-gray-700 text-sm mb-0">Ничего не выбрано - выберите приоритет, автора или перезагрузите страницу</h3>
    </div>
  <?php
 }
?>

<?php if($query->rowCount()):
  while($row = $query->fetch(PDO::FETCH_ASSOC)){ ?>
  <div id="<?php echo $row['id']; ?>" class="card my-5 bg-white shadow-sm rounded-md py-3 px-4 my-4 relative overflow-hidden" >
  <h3 class="font-bold text-gray-700 text-sm mb-0"><?php echo $row['title']; ?></h3>
  <p class="my-4 text-sm leading-6" style="overflow-wrap: anywhere;"><?php echo $row['body']; ?></p>
  <?php if ($row['priority'] === 'low'): ?>
    <div class='pill absolute bottom-0 right-0 rounded-tl-md bg-emerald-300 text-emerald-600 py-1 px-2 mt-3 inline-block text-xs font-semibold'>
    <button onclick="openModal()" class="button" type="button" data-action="<?php echo $row['id']; ?>" data-modal-target="crypto-modal<?php echo $row['id']; ?>" data-modal-toggle="crypto-modal"><?php echo $row['priority']; ?> priority</a></button>
    </div>
  <?php endif ?>
  <?php if ($row['priority'] === 'middle'): ?>
    <div class='pill absolute bottom-0 right-0 rounded-tl-md bg-orange-300 text-orange-600 py-1 px-2 mt-3 inline-block text-xs font-semibold'>
    <button onclick="openModal()" class="button" type="button" data-action="<?php echo $row['id']; ?>" data-modal-target="crypto-modal<?php echo $row['id']; ?>" data-modal-toggle="crypto-modal"><?php echo $row['priority']; ?> priority</a></button>
    </div>
  <?php endif ?>
  <?php if ($row['priority'] === 'high'): ?>
    <div class='pill absolute bottom-0 right-0 rounded-tl-md bg-indigo-300 text-indigo-600 py-1 px-2 mt-3 inline-block text-xs font-semibold'>
    <button onclick="openModal()" class="button" type="button" data-action="<?php echo $row['id']; ?>" data-modal-target="crypto-modal<?php echo $row['id']; ?>" data-modal-toggle="crypto-modal"><?php echo $row['priority']; ?> priority</a></button>
    </div>
  <?php endif ?>
  <p class="text-sm text-gray-700 text-sm"><?php echo $row['author']; ?></p>
      <!-- Main modal -->
      <div id="crypto-modal<?php echo $row['id']; ?>" tabindex="-1" aria-hidden="true" class="crypto-modal overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
    <div class="modal-me absolute p-4 w-full max-w-md max-h-full m-auto right-0 left-0">
        <!-- Modal content -->
        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
            <!-- Modal header -->
            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                <h3 class="text-lg font-semibold text-gray-900 dark:text-white">
                  Change note priority #id <?php echo $row['id']; ?>
                </h3>
                <button onclick="closeModal()" data-action="<?php echo $row['id']; ?>" type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm h-8 w-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="crypto-modal">
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
                    <button onclick="handleSub()" value="submit" id="sub" type="submit" data-action="<?php echo $row['id']; ?>" class="btn bg-blue-500 font-bold py-2 px-4 rounded mt-2 text-white hover:bg-blue-700">Post</button>
                </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
    </div>
  <?php }
  ?>
<?php endif; ?>
