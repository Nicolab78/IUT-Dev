notes <- c(12, 8, 15, 19, 7, 11, 14, 16, 9, 13, 18, 12, 15, 6)

moyenne <- mean(notes)
mediane <- median(notes)
ecart_type <- sd(notes)
variance <- var(notes)

cat("Moyenne :", moyenne, "\n")
cat("Médiane :", mediane, "\n")
cat("Ecart-Type :",ecart_type, "\n")
cat("Variance :",variance, "\n")

nb_admis <- sum(notes >= 10)
cat("Nombre d'étudiant avec notes >= 10 :", nb_admis, "\n")
notes[notes >= 10]

hist(notes,
     main = "Distribution des notes",
     xlab = "Note",
     ylab = "Effectif",
     col = "lightblue",
     breaks = 8)


