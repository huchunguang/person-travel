$("#approver_comment").on('input', function() {
	var comment = this.value;
	$("#btnRejectTravel").prop('disabled', comment.length <= 0);
});

