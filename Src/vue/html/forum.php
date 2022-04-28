<div class="forum_contenu">
<p class="titre_lesson">Forum <span class="nom_prof">discussion</span> </p>
    <div class="forum_inner">
        <ul class="liste_forum">
        <?php foreach ($arrayForum as $forum): ?>
            <li class=item_forum>
                <p class=titre_forum><?php echo $forum->getNom() ?></p>
                <ul class=liste_canal>
                <?php foreach($arrayCanal[$forum->getId()] as $canal): ?>
                    <li class=item_canal>
                        <a href=/canal/<?php echo $canal->getId(); ?>>
                            <p class=contenu><?php echo $canal->getNom(); ?></p>
                            <p class=createur_canal> Crée par : <?php echo $arrayCreateur[$canal->getId()]; ?></p>
                        </a>
                    </li>
                <?php endforeach ?>
                    <li class="item_btn_add">
                        <button class="btn_add_canal"><?php echo "<a href=/addCanal/".$forum->getId().">" ?> <i class='bx bx-message-alt-add'></i><span>Ajoute un canal</span></a></button>
                    </li>
                </ul>
            </li>
        <?php endforeach ?>
        </ul>
    </div>
    <div class="admin_part">
                    <div class="btn_add">
                        <button class="btn_add"><a href="/addForum"><i class='bx bx-folder-plus'></i><span>Ajoute un forum</span></a></button>
                    </div>
                   
    </div>
</div>