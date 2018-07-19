function getXMLHttpRequest()
{
    if (window.XMLHttpRequest) {
        return new XMLHttpRequest();
    }

    return new ActiveXObject('Microsoft.XMLHTTP');
}