<?php
//Truy vấn dữ Dữ liệu bang contact
class Contact extends Database
{
    public function __construct()
    {
        parent::__construct();
        $this->table = $this->TableName('contact');
    }
    function contact_row($args = [])
    {
        $strWhere = "";
        if ($args != null) {
            //Thiết lập điều kiện truy vấn theo trạng thái
            if (array_key_exists('status', $args)) {
                $strWhere .= "status='" . $args['status'] . "'";
            }
            //Truy vấn dựa vào id
            if (array_key_exists('id', $args)) {
                if ($strWhere == "") {
                    $strWhere .= "id='" . $args['id'] . "'";
                } else {
                    $strWhere .= " AND id='" . $args['id'] . "'";
                }
            }
            //Truy vấn dựa vào islugd
            if (array_key_exists('slug', $args)) {
                if ($strWhere == "") {
                    $strWhere .= "slug='" . $args['slug'] . "'";
                } else {
                    $strWhere .= " AND slug='" . $args['slug'] . "'";
                }
            }
        }
        //Kiểm tra có điều kiện hay không
        if ($strWhere != "") {
            $strWhere = " WHERE $strWhere";
        }
        $sql = "SELECT * FROM $this->table $strWhere LIMIT 1";
        return $this->getRow($sql);
    }
    function contact_list($args = [])
    {
        $strWhere = "";
        $strSort = "";
        $strLimit = "";
        if ($args != null) {
            //Thiết lập điều kiện truy vấn theo trạng thái
            if (array_key_exists('status', $args)) {
                if ($args['status'] == 'index') {
                    $strWhere .= "status!='0'";
                } else {
                    if ($args['status'] == 'trash') {
                        $strWhere .= "status='0'";
                    } else {
                        $strWhere .= "status='" . $args['status'] . "'";
                    }
                }
            }
            //Truy vẫn dữ liệu theo catid
            if (array_key_exists('catid', $args)) {
                if ($strWhere == "") {
                    $strWhere .= "catid='" . $args['catid'] . "'";
                } else {
                    $strWhere .= " AND catid='" . $args['catid'] . "'";
                }
            }
            //Truy vẫn dữ liệu theo nhiều catid
            if (array_key_exists('catid_in', $args)) {
                $strin = implode(',', $args['catid_in']);
                if ($strWhere == "") {
                    $strWhere .= "catid IN (" . $strin . ")";
                } else {
                    $strWhere .= " AND catid IN (" . $strin . ")";
                }
            }
            //Truy vẫn dữ liệu không lấy id=2
            if (array_key_exists('not_id', $args)) {
                if ($strWhere == "") {
                    $strWhere .= "id!='" . $args['not_id'] . "'";
                } else {
                    $strWhere .= " AND id!='" . $args['not_id'] . "'";
                }
            }
            //Sắp xếp
            if (array_key_exists('sort', $args)) {
                $strSort .= " ORDER BY " . $args['sort']['orderby'] . " " . $args['sort']['order'];
            }
            //Giới hạn mẫu tin
            if (array_key_exists('offset', $args) && array_key_exists('limit', $args)) {
                $strLimit .=  "LIMIT " . $args['offset'] . ", " . $args['limit'];
            } else {
                if (array_key_exists('limit', $args)) {
                    $strLimit .=  "LIMIT " . $args['limit'];
                }
            }
        }
        //Kiểm tra có điều kiện hay không
        if ($strWhere != "") {
            $strWhere = " WHERE $strWhere";
        }
        $sql = "SELECT * FROM $this->table $strWhere $strSort $strLimit";
        return $this->getList($sql);
    }
    function contact_count($args = [])
    {
        $strWhere = "";
        $strSort = "";
        $strLimit = "";
        if ($args != null) {
            //Thiết lập điều kiện truy vấn theo trạng thái
            if (array_key_exists('status', $args)) {
                if ($args['status'] == 'index') {
                    $strWhere .= "status!='0'";
                } else {
                    if ($args['status'] == 'trash') {
                        $strWhere .= "status='0'";
                    } else {
                        $strWhere .= "status='" . $args['status'] . "'";
                    }
                }
            }
            //Truy vẫn dữ liệu theo catid
            if (array_key_exists('catid', $args)) {
                if ($strWhere == "") {
                    $strWhere .= "catid='" . $args['catid'] . "'";
                } else {
                    $strWhere .= " AND catid='" . $args['catid'] . "'";
                }
            }
            //Truy vẫn dữ liệu theo nhiều catid
            if (array_key_exists('catid_in', $args)) {
                $strin = implode(',', $args['catid_in']);
                if ($strWhere == "") {
                    $strWhere .= "catid IN (" . $strin . ")";
                } else {
                    $strWhere .= " AND catid IN (" . $strin . ")";
                }
            }
            //Truy vẫn dữ liệu không lấy id=2
            if (array_key_exists('not_id', $args)) {
                if ($strWhere == "") {
                    $strWhere .= "id!='" . $args['not_id'] . "'";
                } else {
                    $strWhere .= " AND id!='" . $args['not_id'] . "'";
                }
            }
        }
        //Kiểm tra có điều kiện hay không
        if ($strWhere != "") {
            $strWhere = " WHERE $strWhere";
        }
        $sql = "SELECT * FROM $this->table $strWhere";
        return $this->getCount($sql);
    }
    function contact_insert($data)
    {
        $strf = "";
        $strv = "";
        foreach ($data as $f => $v) {
            $strf .= $f . ", ";
            $strv .= "'$v', ";
        }
        $strf = rtrim(rtrim($strf), ',');
        $strv = rtrim(rtrim($strv), ',');
        $sql = "INSERT INTO $this->table($strf) VALUES ($strv)";
        $this->setQuery($sql);
    }
    function contact_update($data, $id)
    {
        $strset = "";
        foreach ($data as $f => $v) {
            $strset .= $f . "='$v', ";
        }
        $strset = rtrim(rtrim($strset), ',');
        $sql = "UPDATE $this->table SET $strset WHERE id='$id'";
        $this->setQuery($sql);
    }
    function contact_delete($id)
    {
        $sql = "DELETE FROM $this->table WHERE id='$id'";
        $this->setQuery($sql);
    }  
}
