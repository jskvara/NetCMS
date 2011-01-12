
var nodiac = { 'á': 'a', 'č': 'c', 'ď': 'd', 'é': 'e', 'ě': 'e', 'í': 'i', 'ň': 'n', 'ó': 'o', 'ř': 'r', 'š': 's', 'ť': 't', 'ú': 'u', 'ů': 'u', 'ý': 'y', 'ž': 'z' };
/** Vytvoření přátelského URL
* @param string řetězec, ze kterého se má vytvořit URL
* @return string řetězec obsahující pouze čísla, znaky bez diakritiky, podtržítko a pomlčku
* @copyright Jakub Vrána, http://php.vrana.cz/
*/
function makeUrl(s) {
    s = s.toLowerCase();
    var s2 = '';
    for (var i=0; i < s.length; i++) {
        s2 += (typeof nodiac[s.charAt(i)] != 'undefined' ? nodiac[s.charAt(i)] : s.charAt(i));
    }
    
    return s2.replace(/[^a-z0-9]+/g, '-').replace(/^-|-$/g, '');
}

