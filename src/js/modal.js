$(document).ready( function () {
  $('#delUserModal').on('show.bs.modal', function(e) {
    var button = $(e.relatedTarget);
    var uid = button.data('uid');
    var lvl = button.data('lvl');

    var modal = $(this);
    modal.find(".modal-body p strong#delUserText").text(uid);
    modal.find(".modal-body input[name=uid]").val(uid);
    modal.find(".modal-body input[name=lvl]").val(lvl);
  });

  $('#changeUserStatusModal').on('show.bs.modal', function(e) {
    var button = $(e.relatedTarget);
    var uid = button.data('uid');
    var sts = button.data('sts');

    var modal = $(this);
    modal.find(".modal-body p strong#changeUserStatusText").text(uid);
    modal.find(".modal-body input[name=uid]").val(uid);
    modal.find(".modal-body input[name=sts]").val(sts);
  });

  $('#delRinvoiceModal').on('show.bs.modal', function(e) {
    var button = $(e.relatedTarget);
    var rid = button.data('rid');

    var modal = $(this);
    modal.find(".modal-body p strong#delRinvoiceText").text(rid);
    modal.find(".modal-body input[name=rid]").val(rid);
  });

  $('#confirmModal').on('show.bs.modal', function(e) {
    var button = $(e.relatedTarget);
    var rid = button.data('rid');

    var modal = $(this);
    modal.find(".modal-body p strong#confirmText").text(rid);
    modal.find(".modal-body input[name=rid]").val(rid);
  });
});

