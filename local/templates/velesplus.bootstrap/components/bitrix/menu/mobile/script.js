/**
 * Open menu nodes
 * @param oThis
 * @returns {boolean}
 * @constructor
 */
function OpenMenuNode(oThis)
{
	if (oThis.className == 'menu-open')
		oThis.className = 'menu-close';
	else
		oThis.className = 'menu-open';
	return true;
}
