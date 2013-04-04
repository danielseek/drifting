<?php

/**
 * Description of ValueNotSetException
 *
 * @author Daniel Sykora (jsem@dsykora.cz)
 */
//Model exceptions
class ModelException extends Exception {}
class MissingValueException extends ModelException {}
class PluginException extends Exception {}
class NotFoundException extends Exception {}
class UploadException extends Exception {}
?>
