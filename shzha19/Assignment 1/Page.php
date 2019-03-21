<?php
class Page {
    public $totalRows;                      //总记录数
    public $pageSize;                       //每页几条
    public $limit;                          //limit字串
    public $currentPageNum;                 //当前第几页
    public $totalPageNum;                   //总页数
    private $url;                           //当前url
    private $bothNum = 4;                   //分页数字当前页两边有几个可点页
    private $sign;                          //url中page前面是&还是?

    //构造方法
    public function __construct($totalRows, $pageSize = 2){
        $this->totalRows = $totalRows ? $totalRows : 1;
        $this->pageSize = $pageSize;
        $this->totalPageNum = ceil($this->totalRows / $this->pageSize);
        $this->currentPageNum = $this->getCurrentPage();
        $this->url = $this->getUrl();
        $this->limit = $this->getLimit();
    }



    public function show(){
        echo $this->first()."&nbsp;&nbsp;";
        echo $this->prev()."&nbsp;&nbsp;";
        echo $this->pageList()."&nbsp;";
        echo $this->next()."&nbsp;&nbsp;";
        echo $this->last()."&nbsp;";
        // echo '<hr>';
        // echo $page->limit;
    }

    /*
        1 当前页不存在 1
        2 当前页存在 但大于总页数 取总页数
        3 当前页存在 在1~总页数之间 去当前页

    */
    private function getCurrentPage(){
         if (!empty($_GET['page'])) {  
                if ($_GET['page'] > 0) {
                   if ($_GET['page'] > $this->totalPageNum) {  
                          return $this->totalPageNum;  
                   } else {  
                          return $_GET['page'];  
                   }  
                } else {  
                   return 1;  
                }  
         } else {  
                return 1;  
         }  
    }

    //获取当前url并解析参数去掉page参数 确定page前是? or &
    private function getUrl(){
        // echo '<pre>';
        // print_r($_SERVER);
        // echo '</pre>';exit;

        $url = $_SERVER['REQUEST_URI'];
        $urlDetail = parse_url($url);
        // echo '<pre>';
        // print_r($urlDetail);
        // echo '</pre>';exit;
        if(isset($urlDetail['query'])){
            parse_str($urlDetail['query'],$params);
            unset($params['page']);
            if(count($params) > 0) {
                $url = $urlDetail['path'].'?'.http_build_query($params);
                $this->sign = '&';
            } else {
                $url = $urlDetail['path'];
                $this->sign = '?';
            }
        }
		else{
			 $url = $urlDetail['path'].'?';
		}
        return $url;
    }

    private function getLimit(){
        if ($this->currentPageNum == $this->totalPageNum) {
            return 'LIMIT '.($this->currentPageNum - 1) * $this->pageSize . ', '.($this->totalRows - ($this->currentPageNum - 1) * $this->pageSize);
        } else {
            return 'LIMIT '.($this->currentPageNum - 1) * $this->pageSize . ', '. $this->pageSize;
        }
    }

    /*
        页码表 默认当前页前后各4个可点的页面
        首页 上一页... 1234 5 6789 ...下一页 尾页
    */
    private function pageList(){
        $pageList = '';

        if ($this->currentPageNum - $this->bothNum > 1) {
            $pageList .= ' ... ';
        }
        //当前页前边的部分
        for($i = $this->bothNum;$i>0;$i--) {
            $_page = $this->currentPageNum - $i;
            if ($_page < 1 ) continue;
            $pageList .= ' <a href="'.$this->url.$this->sign.'page='.$_page.'">'.$_page.'</a> ';

        }
        //当前页
        $pageList .= ' ' . $this->currentPageNum . ' ';
        //当前页之后的部分
        for ($i=1;$i<=$this->bothNum;$i++){
            $_page = $this->currentPageNum + $i;
            if ($_page > $this->totalPageNum) continue;
            $pageList .=' <a href="'.$this->url.$this->sign.'page='.$_page.'">'.$_page.'</a> ';
        }

        if ($this->currentPageNum + $this->bothNum < $this->totalPageNum) {
            $pageList .= ' ... ';
        }
        return $pageList;

    }

    //首页
    private function first(){
        if ($this->currentPageNum > 1) {
            return '<a href="'.$this->url.$this->sign.'page=1">Top</a>';
        }
    }

    //尾页
    private function last(){
        if ($this->currentPageNum < $this->totalPageNum) {
            return '<a href="'.$this->url.$this->sign.'page='.$this->totalPageNum.'">End </a>';
        }
    }

    //上一页
    private function prev(){
        if($this->currentPageNum > 1) {
            return ' <a href="'.$this->url.$this->sign.'page='.($this->currentPageNum - 1).'">Prev</a> ';
        }
    }

    //下一页
    private function next(){
        if($this->currentPageNum < $this->totalPageNum) {
            return ' <a href="'.$this->url.$this->sign.'page='.($this->currentPageNum + 1).'">Next</a> ';
        }
    }

} 