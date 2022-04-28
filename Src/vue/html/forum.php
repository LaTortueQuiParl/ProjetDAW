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
                </ul>
            </li>
        <?php endforeach ?>
        </ul>
    </div>
</div>