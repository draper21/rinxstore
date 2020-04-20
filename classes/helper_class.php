<?
  class helper
  {
    static public function encrypt($id)
    {
      return ($id * 13) + (13 * 13) - 13;
    }

    static public function decrypt($id)
    {
      return ($id - 156) / 13;
    }
  }
?>
