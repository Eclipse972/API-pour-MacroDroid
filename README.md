# API pour MacroDroid
MD propose énormément d'actions mais ce n'est pas un langage de programmation.

Récemment je suis tombé sur cette vidéo: [How to call Web APIs in MacroDroid](https://www.youtube.com/watch?v=PikZoycOXMg)
On y découvre que MD propose deux actions très intéressantes

1.  envoyer une requête http
2.  parser du JSON

Cette perspective m'a ouvert de nouveaux horizons: dépasser les limitations de MD en déportant les traitements compliqués vers un serveur web.

La procédure serait la suivante

1.  MD envoie une requête au serveur avec d'éventuels paramètres
2.  Le serveur traite la requête. Ce traitement peut éventuellement appel à d'autres API
3.  Le serveur envoie une réponse au format JSON.
4.  MD exploite cette réponse

Je voulais comme preuve de concept quelque chose de simple mais pas trop compliqué non plus. J'ai choisi ma façon de dire l'heure car l'action de MD ne me convient pas.

Voici les exceptions et approximations dans ma manière de dire l'heure:

- si heure = 0 je dis "minuit". Ex: "0h10" -&gt; "minuit 10"
- si heure = 12 je dis "midi". Ex : "12h20" -&gt; "midi 20"
- si minute = 0 je ne dit rien. Ex: "11h00" -&gt; "11 heure"
- si minute entre 13 et 16 et heure &lt; 13 je dis "et quart". Ex; "9h13" -&gt; "9 heure et quart" par contre 15h16 reste inchangé.
- si minute entre 28 et 31 et heure &lt; 13 je dis "et demi". Ex: "11h27" -&gt; "11 heure et demi" mais 13h30 reste inchangé.

Pour déterminer l'heure je ne vais pas utiliser l'heure système mais utiliser [Time API](https://www.timeapi.io//) pour m'entrainer à exploiter une API dans le traitement de mon serveur web. Pourquoi ce choix?
Time API donne l'heure locale au point GPS spécifié.

La réponse du serveur sera un objet JSON:

```
{
    "heure" : "ma manière de dire l'heure ou un message d'erreur"
}
```

Données qui seront intégrées à la phrase qui sera lue par la synthèse vocale de MD

Mon serveur:

- un hébergement web sur lequel j'ai créé un sous-domaines pour l'expérience
- php 8

Pour les plus geek ça ne devrait pas être difficile d'utiliser à la place un Raspberry PI avec une application en python.
