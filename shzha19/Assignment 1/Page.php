<?php
class Page {
    public $totalRows;                      //�ܼ�¼��
    public $pageSize;                       //ÿҳ����
    public $limit;                          //limit�ִ�
    public $currentPageNum;                 //��ǰ�ڼ�ҳ
    public $totalPageNum;                   //��ҳ��
    private $url;                           //��ǰurl
    private $bothNum = 4;                   //��ҳ���ֵ�ǰҳ�����м����ɵ�ҳ
    private $sign;                          //url��pageǰ����&����?

    //���췽��
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
        1 ��ǰҳ������ 1
        2 ��ǰҳ���� ��������ҳ�� ȡ��ҳ��
        3 ��ǰҳ���� ��1~��ҳ��֮�� ȥ��ǰҳ

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

    //��ȡ��ǰurl����������ȥ��page���� ȷ��pageǰ��? or &
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
        ҳ��� Ĭ�ϵ�ǰҳǰ���4���ɵ��ҳ��
        ��ҳ ��һҳ... 1234 5 6789 ...��һҳ βҳ
    */
    private function pageList(){
        $pageList = '';

        if ($this->currentPageNum - $this->bothNum > 1) {
            $pageList .= ' ... ';
        }
        //��ǰҳǰ�ߵĲ���
        for($i = $this->bothNum;$i>0;$i--) {
            $_page = $this->currentPageNum - $i;
            if ($_page < 1 ) continue;
            $pageList .= ' <a href="'.$this->url.$this->sign.'page='.$_page.'">'.$_page.'</a> ';

        }
        //��ǰҳ
        $pageList .= ' ' . $this->currentPageNum . ' ';
        //��ǰҳ֮��Ĳ���
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

    //��ҳ
    private function first(){
        if ($this->currentPageNum > 1) {
            return '<a href="'.$this->url.$this->sign.'page=1">Top</a>';
        }
    }

    //βҳ
    private function last(){
        if ($this->currentPageNum < $this->totalPageNum) {
            return '<a href="'.$this->url.$this->sign.'page='.$this->totalPageNum.'">End </a>';
        }
    }

    //��һҳ
    private function prev(){
        if($this->currentPageNum > 1) {
            return ' <a href="'.$this->url.$this->sign.'page='.($this->currentPageNum - 1).'">Prev</a> ';
        }
    }

    //��һҳ
    private function next(){
        if($this->currentPageNum < $this->totalPageNum) {
            return ' <a href="'.$this->url.$this->sign.'page='.($this->currentPageNum + 1).'">Next</a> ';
        }
    }

} 