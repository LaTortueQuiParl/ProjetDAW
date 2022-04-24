<?php
    require_once("Src/Modele/bdd.php");
    require_once("Src/Controleur/tag.php");

    class TagDAO {
        /**
         * @return array[Tag] Les matières dans la base
         */
        public static function getAll(){
            try{
                $data = BDD::query("SELECT * FROM projet.tag;");
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            }
            $res = array();
            if ($data !== false){
                foreach($data as $row){
                    array_push($res, self::fromRow($row));
                }
            }
            return $res;
        }
        
        /**
         * @param entier $id
         * @return Tag Le tag de la base correspondant à l'id en paramètre
         */
        public static function getById($id){
            try{
                $req = BDD::prepAndExec("SELECT * FROM projet.tag WHERE id=:i;", [":i" => "$id"])->fetchALL();
                return !empty($req) ? self::fromRow($req[0]) : false;
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            }
        }

        /**
         * @param string $contenu
         * @return Tag Le tag de la base correspondant au contenu en paramètre
         */
        public static function getByContenu($contenu){
            try{
                $req = BDD::prepAndExec("SELECT * FROM projet.tag WHERE contenu=:c;", [":c" => "$contenu"])->fetchALL();
                return !empty($req) ? self::fromRow($req[0]) : false;
            } catch (PDOException $e){
                echo $e->getMessage()."<br>";
                return false;
            }
        }

        /**
         * Permet de récupérer les tags associés à une matière
         *
         * @param Matiere $m
         * @return array[Tag] Un tableau contenant tous les tags associés à la matière donné en argument
         */
        public static function getByMatiere($m){
            if(!is_null($m->getId())){
                $req = BDD::prepAndExec("SELECT t.id AS id, t.contenu AS contenu FROM projet.matiere AS m, projet.matiere_tag AS mt, projet.tag AS t
                                            WHERE m.id=mt.id_mat AND mt.id_tag=t.id AND m.id=:id;",
                                        array("id" => $m->getId()))->fetchAll();
                return !empty($req) ? array_map("self::fromRow", $req) : $req;
            }
        }

        /**
         * Insère un tag dans la base de données (mise à jour si le tag existe déja)
         * 
         * @param Tag $m
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function create($t){
            if (!is_null($t->getId())){
                try{
                    return BDD::prepAndExec("UPDATE projet.tag SET contenu=:c WHERE id=:i;",
                        array(
                            "i" => $t->getId(),
                            "c" => $t->getContenu()
                        ));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            } else {
                try{
                    return BDD::prepAndExec("INSERT INTO projet.tag(contenu) VALUES(:c);",
                    array(
                        "c" => $t->getContenu()
                    ));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            }
        }

        /**
         * Supprime le tag passée en paramètre de la base
         * 
         * @param Tag $t
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function delete($t){
            if(!is_null($t->getId())){
                try{
                    return BDD::prepAndExec("DELETE FROM projet.tag WHERE id=:i;", array('i' => $t->getId()));
                } catch (PDOException $e){
                    echo $e->getMessage() . "<br>";
                    return false;
                }
            }
        }

        /**
         * Supprime toutes les tags de la table tag
         *
         * @return false/PDOStatement Renvoie faux si la requête a échoué, PDOStatement de la requête sinon
         */
        public static function deleteAll(){
            try{
                return BDD::query("DELETE FROM projet.tag;");
            } catch (PDOException $e){
                echo $e->getMessage() . "<br>";
                return false;
            }
        }

        /**
         * Fonction privée traduisant le retour de la BDD en reponse
         *
         * @param array[] $tow
         * @return Tag
         */
        private static function fromRow($row){
            return new Tag(
                $row['id'],
                $row['contenu']
            );
        }
    }
?>