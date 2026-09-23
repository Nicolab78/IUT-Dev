duree <- c(980, 1020, 995, 1010, 970, 1005, 1030, 990, 1015, 1000)

m <- mean(duree)
s <- sd(duree)
n <- length(duree)
cat("Moyenne :", m ,"-Ecart-type :", round(s, 2), "\n")

erreur_std <- s / sqrt(n)
marge <- qt(0.975, df = n - 1) * erreur_std
ic_bas <- m - marge
ic_haut <- m + marge
cat("IC à 95% : [", round(ic_bas, 1), ";", round(ic_haut, 1), "]\n")

resultat_test <- t.test(duree, mu = 1000)
print(resultat_test)