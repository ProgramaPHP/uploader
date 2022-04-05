<?php

namespace CoffeeCode\Uploader;

use Exception;

/**
 * Class CoffeeCode File
 *
 * @author Robson V. Leite <https://github.com/robsonvleite>
 * @package CoffeeCode\Uploader
 */
class File extends Uploader
{
    /**
     * Allow zip, rar, bzip, pdf, doc, docx, csv, xls, xlsx, ods, odt files
     * @var array allowed file types
     * https://www.freeformatter.com/mime-types-list.html
     */
    protected static array $allowTypes = [
        "application/pdf",
        "text/csv",
        "application/vnd.oasis.opendocument.text",
        "text/plain"
    ];

    /**
     * Allowed extensions to types.
     * @var array
     */
    protected static array $extensions = [
        "pdf",
        "csv",
        "txt"
    ];

    /**
     * @param array $file
     * @param string $name
     * @return string
     * @throws Exception
     */
    public function upload(array $file, string $name): string
    {
        $this->ext($file);

        if (!in_array($file['type'], static::$allowTypes) || !in_array($this->ext, static::$extensions)) {
            throw new Exception("Not a valid file type or extension");
        }

        $this->name($name);
        move_uploaded_file($file['tmp_name'], "{$this->path}/{$this->name}");
        return "{$this->path}/{$this->name}";
    }
}
