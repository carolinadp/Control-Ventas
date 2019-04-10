var $TABLE = $('#table');
var $BTN = $('#export-btn');
var $EXPORT = $('#export');

$('.table-add').click(function () {
  var $clone = $TABLE.find('tr.hide').clone(true).removeClass('hide table-line');
  jQuery.ajax({
    type: "POST",
    url: 'db_lineas.php',
    dataType: 'json',
    data: {functionname: 'insertLineaDeProducto', arguments: []},
    success: function (obj, textstatus) {
                  console.log(obj);
                  console.log(textstatus);
                  if( textstatus == "success" ) {
                      idLinea = obj;
                      $clone.find('td#idLinea').html(idLinea);
                      $clone.find('td#nombreLinea').html('Nueva linea');
                      $clone.find('td#comisionLinea').html('0.0');
                  }
                  else {
                      console.log(obj.error);
                  }
            }
  });
  
  console.log($clone);
  $TABLE.find('table').append($clone);
});

$('.table-remove').click(function () {
  var $id = $(this).parents('tr');
  console.log($id.parents('tr').find('td#idLinea'));
  $(this).parents('tr').detach();
  /*
  jQuery.ajax({
    type: "POST",
    url: 'db_lineas.php',
    dataType: 'json',
    data: {functionname: 'insertLineaDeProducto', arguments: []},
    success: function (obj, textstatus) {
                  console.log(obj);
                  console.log(textstatus);
                  if( textstatus == "success" ) {
                      idLinea = obj;
                      $clone.find('td#idLinea').html(idLinea);
                      $clone.find('td#nombreLinea').html('Nueva linea');
                      $clone.find('td#comisionLinea').html('0.0');
                  }
                  else {
                      console.log(obj.error);
                  }
            }
  });
  */
});

$('.table-up').click(function () {
  var $row = $(this).parents('tr');
  if ($row.index() === 1) return; // Don't go above the header
  $row.prev().before($row.get(0));
});

$('.table-down').click(function () {
  var $row = $(this).parents('tr');
  $row.next().after($row.get(0));
});

// A few jQuery helpers for exporting only
jQuery.fn.pop = [].pop;
jQuery.fn.shift = [].shift;

$BTN.click(function () {
  var $rows = $TABLE.find('tr:not(:hidden)');
  var headers = [];
  var data = [];
  
  // Get the headers (add special header logic here)
  $($rows.shift()).find('th:not(:empty)').each(function () {
    headers.push($(this).text().toLowerCase());
  });
  
  // Turn all existing rows into a loopable array
  $rows.each(function () {
    var $td = $(this).find('td');
    var h = {};
    
    // Use the headers from earlier to name our hash keys
    headers.forEach(function (header, i) {
      h[header] = $td.eq(i).text();   
    });
    
    data.push(h);
  });
  
  // Output the result
  $EXPORT.text(JSON.stringify(data));
});