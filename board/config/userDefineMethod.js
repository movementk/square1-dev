//���ڿ��� �¿���� ����
String.prototype.trim = function(Obj) {
	var returnValue = this.replace(/(^ *)|( *$)/g, "");

	if(Obj)
		Obj.value = returnValue;

	return returnValue;
}

//������üũ ����ȭ �޽��
String.prototype.number = function() {
	var re = /[0-9]/g;
	
	if(this.replace(re,"") != "") return false;
	return true;
}

//����Ÿ��üũ ����ȭ �޽��
String.prototype.onlyNumber = function() {
	
	if(this.number()) {
		var num = parseInt(this);
		var tmpnum = num.toString();

		if(tmpnum == this) {
			return true;
		} else {
			return false;
		}
	} else {
		return false;
	}
}