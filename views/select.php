<div class="select-container mt-3">
    <select name="select" class="form-select text-black/70 bg-white px-2 py-1 transition-all hover:border-indigo-600/30 border border-indigo-200 rounded-lg outline-indigo-300/50 appearance-none invalid:text-black/30 w-64" id="selectid">
      <option>Выбор автора</option>
      <?php foreach ($resulttwo as $restwo) { ?>
      <option value="<?php echo $restwo->author; ?>"><?php echo $restwo->author; ?></option>
      <?php } ?>
    </select>
    <select name="selecttwo" class="form-select text-black/70 bg-white px-2 py-1 transition-all hover:border-indigo-600/30 border border-indigo-200 rounded-lg outline-indigo-300/50 appearance-none invalid:text-black/30 w-64" id="selectidtwo">
      <option selected="selected">Выбор приоритета</option>
      <option value="all">all</option>
      <?php foreach ($resultthree as $resthree) { ?>
      <option value="<?php echo $resthree->priority; ?>"><?php echo $resthree->priority; ?></option>
      <?php } ?>
    </select>
  </div>
