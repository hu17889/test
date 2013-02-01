<?php



class StatController extends Controller
{
    public function actionPointStat() 
    {
        switch($_REQUEST['type']) {
        case 'down':
            $model = new Question();
            if(!$model->savePointStartInfo($_REQUEST)) {
                echo 1;
            } else {
                echo 0;
            }
            break;
        case 'up':
            $model = new Question();
            if(!$model->savePointEndInfo($_REQUEST)) {
                echo 1;
            } else {
                echo 0;
            }
            break;
        default:
            break;
        }
    }
}


